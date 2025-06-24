<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\ACUAPONICO\Entities\SpeciesAquaponic;
use Modules\ACUAPONICO\Entities\CropAquaponic;

class CropAquaponicController extends Controller
{
    public function index()
    {
        $especies = SpeciesAquaponic::all();
        $cultivos = CropAquaponic::with(['species', 'lot'])->get();
        $lotes = Lot::where('state', 'disponible')->get();
        $lotes = Lot::all();

        return view('acuaponico::pasante.cultivos', compact('especies', 'lotes'));
    }

    public function create()
    {
        return view('acuaponico::create');
    }

    public function store(Request $request)
    {

        $lot = Lot::findOrFail($request->lot_id);

        // Calcular la cantidad ya cultivada en el lote
        $cantidadActual = CropAquaponic::where('lot_id', $lot->id)->sum('quantity');

        $cantidadNueva = $request->quantity;

        if (($cantidadActual + $cantidadNueva) > $lot->capacity) {
            return redirect()->back()
                ->withInput()
                ->with('error', "La cantidad excede la capacidad del lote. Capacidad disponible: " . ($lot->capacity - $cantidadActual));
        }

        $cultivo = new CropAquaponic();
        $cultivo->date = $request->date;
        $cultivo->lot_id = $request->lot_id;
        $cultivo->species_id = $request->species_id;
        $cultivo->quantity = $request->quantity;
        $cultivo->status = $request->status;
        $cultivo->save();

        // Cambiar el estado del lote
        $lot->state = 'ocupado';
        $lot->save();

        return redirect()->back()->with('success', 'Cultivo agregado correctamente.');
    }

    public function show($id)
    {
        return view('acuaponico::show');
    }

    public function edit($id)
    {
        return view('acuaponico::edit');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'lot_id' => 'required|exists:lots,id',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|string',
        ]);

        $cultivo = CropAquaponic::findOrFail($id);

        $lot = Lot::findOrFail($request->lot_id);

        // Cantidad cultivada en el lote sin contar el cultivo actual (porque puede cambiar cantidad)
        $cantidadActualSinEste = CropAquaponic::where('lot_id', $lot->id)
            ->where('id', '!=', $cultivo->id)
            ->sum('quantity');

        $cantidadNueva = $request->quantity;

        if (($cantidadActualSinEste + $cantidadNueva) > $lot->capacity) {
            return redirect()->back()
                ->withInput()
                ->with('error', "La cantidad excede la capacidad del lote. Capacidad disponible: " . ($lot->capacity - $cantidadActualSinEste));
        }

        $loteAnteriorId = $cultivo->lot_id; // Guardar el lote anterior

        // Actualizar datos del cultivo
        $cultivo->date = $request->input('date');
        $cultivo->lot_id = $request->input('lot_id');
        $cultivo->species_id = $request->input('species_id');
        $cultivo->quantity = $request->input('quantity');
        $cultivo->status = $request->input('status');
        $cultivo->save();

        // Si cambió el lote, actualizar estados
        if ($loteAnteriorId != $cultivo->lot_id) {
            // Lote anterior ahora está disponible
            $loteAnterior = Lot::find($loteAnteriorId);
            if ($loteAnterior) {
                $loteAnterior->state = 'disponible';
                $loteAnterior->save();
            }

            // Lote nuevo ahora está ocupado
            $loteNuevo = Lot::find($cultivo->lot_id);
            if ($loteNuevo) {
                $loteNuevo->state = 'ocupado';
                $loteNuevo->save();
            }
        }

        return redirect()->back()->with('success', 'Cultivo actualizado correctamente.');
    }

    public function destroy($id)
    {
        $cultivo = CropAquaponic::findOrFail($id);
        $cultivo->delete();

        // Cambiar el estado del lote a disponible
        $lote = Lot::find($cultivo->lot_id);
        $lote->state = 'disponible';
        $lote->save();

        return redirect()->back()->with('success', 'Cultivo eliminado correctamente.');
    }
}
