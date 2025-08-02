<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Lot;
use Illuminate\Database\QueryException;
use Modules\ACUAPONICO\Entities\AquaponicSystem;

class LotController extends Controller
{
    /**
     * Muestra todos los lotes junto con sus cultivos relacionados.
     */
    public function index()
    {
        // Cargar lotes con sus cultivos y sistema acuapónico relacionado
        $acuaponico = AquaponicSystem::get();
        $lots = Lot::with(['cultivos', 'aquaponicSystem'])->get();
        return view('acuaponico::pasante.index', compact('lots', 'acuaponico'));
    }

    public function store(Request $request)
    {

        $lot = new Lot();
        $lot->aquaponic_system_id  = $request->aquaponic_system_id;
        $lot->date = $request->date;
        $lot->name = $request->name;
        $lot->capacity = $request->capacity;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Guardar en carpeta propia de lotes
            $file->move(public_path('modules/acuaponico/images/lotes'), $filename);

            // Guardar solo el nombre del archivo
            $lot->image = $filename;
        }

        $lot->description = $request->description;
        $lot->state = $request->state;
        $lot->save();


        // Actualiza el estado en base a la capacidad y ocupación actual (que es 0)
        $lot->actualizarEstadoAutomatico();

        return redirect()->back()->with('success', 'Lote generado correctamente.');
    }


    /**
     * Actualiza un lote existente.
     */
    public function update(Request $request, $id)
    {
        $lot = Lot::with('cultivos')->findOrFail($id);

        // Calcular cantidad ocupada por cultivos en este lote (desde la tabla pivote)
        $cantidadOcupada = $lot->cultivos->sum('pivot.planted_quantity');

        // Validar que la nueva capacidad no sea menor que lo ya ocupado
        if ($request->capacity < $cantidadOcupada) {
            $cultivo = $lot->cultivos()->with('species')->first();
            $nombreEspecie = $cultivo?->species?->common_name ?? 'cultivo';
            $fechaCultivo = $cultivo?->date ?? 'desconocida';

            return redirect()->back()
                ->withInput()
                ->with('error', 'No se puede reducir la capacidad a ' . $request->capacity .
                    ' porque ya hay ' . $cantidadOcupada . ' unidades ocupadas por el cultivo de ' .
                    $nombreEspecie . ' registrado el ' . $fechaCultivo . '.');
        }

        // Actualizar datos del lote
        $lot->update($request->all());

        // Recalcular automáticamente su estado
        $lot->actualizarEstadoAutomatico();

        return redirect()->route('acuaponico.pasante.pasante.index')->with('success', 'Lote actualizado correctamente.');
    }

    /**
     * Elimina un lote si no tiene restricciones de clave foránea.
     */
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
