<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\ACUAPONICO\Entities\Lot;
use Illuminate\Database\QueryException;
use Modules\ACUAPONICO\Entities\AquaponicSystem;

class LotController extends Controller
{

    public function index()
    {
        // Cargar lotes con sus cultivos y sistema acuapónico relacionado
        $acuaponico = AquaponicSystem::get();
        $lots = Lot::with(['cultivos', 'aquaponicSystem'])->get();
        return view('acuaponico::pasante.index', compact('lots', 'acuaponico'));
    }

    public function showRegistroLote()
    {
    $acuaponico = AquaponicSystem::all();
    $lots = Lot::with(['cultivos', 'aquaponicSystem'])->get();
    return view('acuaponico::admin.registrolote', compact('lots','acuaponico'));
    }


    public function store(Request $request)
    {
        $lot = new Lot();
        $lot->aquaponic_system_id = $request->aquaponic_system_id;
        $lot->date = $request->date;
        $lot->name = $request->name;
        $lot->capacity = $request->capacity;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Guardar en carpeta propia de lotes
            $file->move(public_path('modules/acuaponico/images/lotes'), $filename);

            // Asignar nombre de archivo al modelo
            $lot->image = $filename;
        }
        $lot->description = $request->description;
        $lot->state = $request->state;
        $lot->save();

        // Llama el método que actualiza automáticamente el estado
        $lot->actualizarEstadoAutomatico();

        return redirect()->back()->with('success', 'Lote generado correctamente.');
    }



    /**
     * Actualiza un lote existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:0',
            'state' => 'required|in:disponible,no disponible',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $lot = Lot::with('cultivos')->findOrFail($id);

        // Calcular cantidad ocupada por cultivos en este lote
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
        $lot->name = $request->name;
        $lot->capacity = $request->capacity;
        $lot->state = $request->state;
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($lot->image && file_exists(public_path('modules/acuaponico/images/lotes/' . $lot->image))) {
                unlink(public_path('modules/acuaponico/images/lotes/' . $lot->image));
            }

            // Guardar nueva imagen
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('modules/acuaponico/images/lotes'), $filename);

            // Asignar nuevo nombre al modelo
            $lot->image = $filename;
        };
        $lot->description = $request->description;
        $lot->save();
       
        

            return redirect()->route('acuaponico.admin.admin.registrolote')->with('success', 'Lote actualizado correctamente.');
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
