<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Lot;
use Illuminate\Database\QueryException;
use Modules\ACUAPONICO\Entities\CropAquaponic;

class LotController extends Controller
{

    public function index()
    {
        $lots = Lot::with('cultivos')->get();
        return view('acuaponico::pasante.index')->with(['lots' => $lots]);
    }

    public function showRegistroLote()
    {
        $lots = Lot::with('cultivos')->get();
        return view('acuaponico::admin.registrolote')->with(['lots' => $lots]);
    }

    

    /**
     * Muestra el formulario de creación (no usado actualmente).
     */
    public function create()
    {
        return view('acuaponico::create');
    }

    /**
     * Guarda un nuevo lote.
     */
    public function store(Request $request)
    {

    $request->validate([
        'date' => 'required|date',
        'name' => 'required|string',
        'capacity' => 'required|integer',
        'state' => 'required|string',
        'image' => 'nullable|image|max:2048', 
    ]);

    $imageName = null;
    
    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/lotes', $imageName); // se guarda en storage/app/public/lotes
    }

        $lot = new Lot();
        $lot->date = $request->date;
        $lot->name = $request->name;
        $lot->capacity = $request->capacity;
        $lot->state = $request->state;
        $lot->image = $imageName ? 'storage/lotes/' . $imageName : null; // Guardar ruta relativa

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
        $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:0',
            'state' => 'required|in:disponible,no disponible',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',        ]);

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
            // Opcional: eliminar imagen anterior si lo deseas
            if ($lot->image && file_exists(public_path($lot->image))) {
                unlink(public_path($lot->image));
            }

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/lotes'), $imageName);
            $lot->image = 'uploads/lotes/' . $imageName;
        }

        $lot->save();

        
        // $lot->actualizarEstadoAutomatico(); // Comentar si interfiere con la selección manual

        if ($request->from === 'admin') {
            return redirect()->route('acuaponico.admin.admin.registrolote')->with('success', 'Lote actualizado correctamente.');
        } else {
            return redirect()->route('acuaponico.pasante.pasante.index')->with('success', 'Lote actualizado correctamente.');
        }
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
