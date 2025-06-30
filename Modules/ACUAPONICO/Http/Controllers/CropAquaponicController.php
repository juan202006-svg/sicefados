<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\ACUAPONICO\Entities\SpeciesAquaponic;
use Modules\ACUAPONICO\Entities\CropAquaponic;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class CropAquaponicController extends Controller
{
    public function index()
    {
        $especies = SpeciesAquaponic::all();
        $cultivos = CropAquaponic::with(['species', 'lotes'])->get();

        // Todos los lotes con capacidad y estado
        $lotesTodos = Lot::with('cultivos')->get();

        // Agregamos manualmente la ocupación de cada cultivo en cada lote
        foreach ($lotesTodos as $lote) {
            $ocupaciones = [];
            foreach ($lote->cultivos as $cultivo) {
                $ocupaciones[$cultivo->id] = $cultivo->pivot->planted_quantity;
            }
            $lote->ocupaciones = $ocupaciones;
        }

        $lotesDisponibles = $lotesTodos->where('state', 'disponible');

        return view('acuaponico::pasante.cultivos', compact('especies', 'lotesDisponibles', 'cultivos', 'lotesTodos'));
    }


    public function create()
    {
        return view('acuaponico::create');
    }

    public function store(Request $request)
    {
        $lotIds = $request->lot_ids;
        $cantidadTotal = $request->quantity;
        $asignaciones = [];

        $capacidadTotal = 0;
        $lotes = [];

        foreach ($lotIds as $lotId) {
            $lot = Lot::findOrFail($lotId);

            $cantidadActual = DB::table('crop_lot')
                ->where('lot_id', $lotId)
                ->sum('planted_quantity');

            $capacidadDisponible = $lot->capacity - $cantidadActual;
            $capacidadTotal += $capacidadDisponible;

            $lotes[] = [
                'id' => $lot->id,
                'disponible' => $capacidadDisponible
            ];
        }

        if ($cantidadTotal > $capacidadTotal) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'La cantidad total supera la capacidad combinada de los lotes seleccionados.');
        }

        foreach ($lotes as $lote) {
            if ($cantidadTotal <= 0) break;

            $asignar = min($cantidadTotal, $lote['disponible']);
            if ($asignar > 0) {
                $asignaciones[$lote['id']] = ['planted_quantity' => $asignar];
                $cantidadTotal -= $asignar;
            }
        }

        $cultivo = new CropAquaponic();
        $cultivo->date = $request->date;
        $cultivo->species_id = $request->species_id;
        $cultivo->quantity = $request->quantity;
        $cultivo->status = $request->status;
        $cultivo->save();

        $cultivo->lotes()->attach($asignaciones);

        foreach (array_keys($asignaciones) as $lotId) {
            $lote = Lot::find($lotId);
            $lote->actualizarEstadoAutomatico();
        }

        return redirect()->back()->with('success', 'Cultivo agregado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $cultivo = CropAquaponic::findOrFail($id);
        $lotIds = $request->lot_ids;
        $cantidadTotal = $request->quantity;
        $asignaciones = [];

        $capacidadTotal = 0;
        $lotes = [];

        foreach ($lotIds as $lotId) {
            $lot = Lot::findOrFail($lotId);

            $cantidadActual = DB::table('crop_lot')
                ->where('lot_id', $lotId)
                ->where('crop_aquaponic_id', '!=', $id)
                ->sum('planted_quantity');

            $capacidadDisponible = $lot->capacity - $cantidadActual;
            $capacidadTotal += $capacidadDisponible;

            $lotes[] = [
                'id' => $lot->id,
                'disponible' => $capacidadDisponible
            ];
        }

        if ($cantidadTotal > $capacidadTotal) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'La cantidad total supera la capacidad combinada de los lotes seleccionados.');
        }

        foreach ($lotes as $lote) {
            if ($cantidadTotal <= 0) break;

            $asignar = min($cantidadTotal, $lote['disponible']);
            if ($asignar > 0) {
                $asignaciones[$lote['id']] = ['planted_quantity' => $asignar];
                $cantidadTotal -= $asignar;
            }
        }

        foreach ($cultivo->lotes as $loteAnterior) {
            $loteAnterior->actualizarEstadoAutomatico();
        }

        $cultivo->date = $request->date;
        $cultivo->species_id = $request->species_id;
        $cultivo->quantity = $request->quantity;
        $cultivo->status = $request->status;
        $cultivo->save();

        $cultivo->lotes()->sync($asignaciones);

        foreach (array_keys($asignaciones) as $lotId) {
            $lote = Lot::find($lotId);
            $lote->actualizarEstadoAutomatico();
        }

        return redirect()->back()->with('success', 'Cultivo actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            $cultivo = CropAquaponic::findOrFail($id);

            // Guardamos los lotes afectados antes del detach
            $lotes = $cultivo->lotes;

            // Primero eliminamos la relación
            $cultivo->lotes()->detach();

            // Luego eliminamos el cultivo
            $cultivo->delete();

            // Finalmente actualizamos el estado de cada lote
            foreach ($lotes as $lote) {
                $lote->actualizarEstadoAutomatico();
            }

            return redirect()->back()->with('success', 'Cultivo eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'No se puede eliminar este cultivo porque está relacionado con otro registro.');
            }

            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar el cultivo.');
        }
    }
}
