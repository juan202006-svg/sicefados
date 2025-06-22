<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Lot;
use Illuminate\Database\QueryException;
use Modules\ACUAPONICO\Entities\CropAquaponic;


class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $lots = Lot::get();
        return view('acuaponico::pasante.index')->with(['lots' => $lots]);
    }




    public function create()
    {
        return view('acuaponico::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {


        $lot = new Lot();
        $lot->date = $request->date;
        $lot->name = $request->name;
        $lot->capacity = $request->capacity;
        $lot->state = $request->state;
        $lot->save();

        return redirect()->back()->with('success', 'Lote generado correctamente.');
    }




    public function update(Request $request, $id)
    {
        $lot = Lot::findOrFail($id);

        // Calcular la cantidad ya ocupada por cultivos en este lote
        $cantidadOcupada = CropAquaponic::where('lot_id', $lot->id)->sum('quantity');

        // Si el nuevo valor de capacidad es menor que lo ya ocupado, bloquear la actualización
        if ($request->capacity < $cantidadOcupada) {
            $cultivo = CropAquaponic::with('species')
                ->where('lot_id', $lot->id)->first();

            $nombreEspecie = $cultivo?->species?->common_name ;
            $fechaCultivo = $cultivo?->date;

            return redirect()->back()
                ->withInput()
                ->with('error', 'No se puede reducir la capacidad a ' . $request->capacity .
                    ' porque ya hay ' . $cantidadOcupada . ' unidades ocupadas por el cultivo de ' .
                    $nombreEspecie . ' registrado el ' . $fechaCultivo . '.');
        }

        // Si pasa la validación, actualizar normalmente
        $lot->update($request->all());

        return redirect()->route('acuaponico.pasante.pasante.index')
            ->with('success', 'Lote actualizado correctamente.');
    }


    public function destroy($id)
    {
        try {
            $lot = Lot::findOrFail($id);
            $lot->delete();

            return redirect()->back()->with('success', 'Lote eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') { 
                return redirect()->back()->with('error', 'No se puede eliminar el lote porque está relacionado con otro registro.');
            }

            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar el lote.');
        }
    }
}
