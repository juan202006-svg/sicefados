<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\ACUAPONICO\Entities\SpeciesAquaponic;
use Modules\ACUAPONICO\Entities\CropAquaponic;
use Illuminate\Database\QueryException;

class CropAquaponicController extends Controller
{
    public function index()
    {
        $especies = SpeciesAquaponic::all();
        $cultivos = CropAquaponic::with(['species', 'lotes'])->get(); // Cambiado a 'lotes'

        $lotesDisponibles = Lot::where('state', 'disponible')->get(); // para agregar
        $lotesTodos = Lot::select('id', 'name', 'state')->get();       // para editar

        return view('acuaponico::pasante.cultivos', compact('especies', 'lotesDisponibles', 'cultivos', 'lotesTodos'));
    }

    public function create()
    {
        return view('acuaponico::create');
    }

    public function store(Request $request)
    {

        $lotIds = $request->lot_ids;

        // Validación de capacidad por lote
        foreach ($lotIds as $lotId) {
            $lot = Lot::findOrFail($lotId);
            $cantidadActual = CropAquaponic::whereHas('lotes', function ($q) use ($lotId) {
                $q->where('lot_id', $lotId);
            })->sum('quantity');

            if (($cantidadActual + $request->quantity) > $lot->capacity) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "La cantidad excede la capacidad del lote '{$lot->name}'. Capacidad disponible: " . ($lot->capacity - $cantidadActual));
            }
        }

        $cultivo = new CropAquaponic();
        $cultivo->date = $request->date;
        $cultivo->species_id = $request->species_id;
        $cultivo->quantity = $request->quantity;
        $cultivo->status = $request->status;
        $cultivo->save();

        // Asocia los lotes
        $cultivo->lotes()->attach($lotIds);

        // Marcar como ocupados
        foreach ($lotIds as $lotId) {
            $lote = Lot::find($lotId);
            $lote->state = 'ocupado';
            $lote->save();
        }

        return redirect()->back()->with('success', 'Cultivo agregado correctamente.');
    }

    public function update(Request $request, $id)
    {

        $cultivo = CropAquaponic::findOrFail($id);
        $lotIds = $request->lot_ids;

        // Validar capacidades nuevamente
        foreach ($lotIds as $lotId) {
            $lot = Lot::findOrFail($lotId);
            $cantidadActual = CropAquaponic::whereHas('lotes', function ($q) use ($lotId, $id) {
                $q->where('lot_id', $lotId);
            })->where('id', '!=', $id)->sum('quantity');

            if (($cantidadActual + $request->quantity) > $lot->capacity) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', "La cantidad excede la capacidad del lote '{$lot->name}'. Capacidad disponible: " . ($lot->capacity - $cantidadActual));
            }
        }

        // Actualizar cultivo
        $cultivo->update([
            'date' => $request->date,
            'species_id' => $request->species_id,
            'quantity' => $request->quantity,
            'status' => $request->status,
        ]);

        // Obtener lotes anteriores y marcar disponibles
        foreach ($cultivo->lotes as $loteAnterior) {
            $loteAnterior->state = 'disponible';
            $loteAnterior->save();
        }

        // Sincronizar nuevos lotes
        $cultivo->lotes()->sync($lotIds);

        // Marcar nuevos lotes como ocupados
        foreach ($lotIds as $lotId) {
            $lote = Lot::find($lotId);
            $lote->state = 'ocupado';
            $lote->save();
        }

        return redirect()->back()->with('success', 'Cultivo actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            $cultivo = CropAquaponic::findOrFail($id);

            // Marcar los lotes como disponibles
            foreach ($cultivo->lotes as $lote) {
                $lote->state = 'disponible';
                $lote->save();
            }

            // Eliminar relación pivote y cultivo
            $cultivo->lotes()->detach();
            $cultivo->delete();

            return redirect()->back()->with('success', 'Cultivo eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'No se puede eliminar este cultivo porque está relacionado con otro registro.');
            }

            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar el cultivo.');
        }
    }
}
