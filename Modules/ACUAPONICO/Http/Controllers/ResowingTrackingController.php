<?php

namespace Modules\ACUAPONICO\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\ACUAPONICO\Entities\Resowing;
use Modules\ACUAPONICO\Entities\ResowingTracking;
use Illuminate\Database\QueryException;

class ResowingTrackingController extends Controller
{
    public function index()
    {
        $sistema = AquaponicSystem::get();
        $resiembras = Resowing::with(['crops.species', 'lots'])->whereIn('status', ['Registrada', 'Seguimiento'])->get();
        $seguimiento_resiembra = ResowingTracking::with('aquaponicSystem', 'resowing.crops.species')->get();
        return view('acuaponico::pasante.seguimiento_resiembra', compact('sistema', 'seguimiento_resiembra', 'resiembras'));
    }

    public function resowingTracking()
    {
        $sistema = AquaponicSystem::get();
        $resiembras = Resowing::with(['crops.species', 'lots'])->whereIn('status', ['Registrada', 'Seguimiento'])->get();
        $seguimiento_resiembra = ResowingTracking::with('aquaponicSystem', 'resowing.crops.species')->get();
        return view('acuaponico::admin.registroseguimiento', compact('sistema', 'seguimiento_resiembra', 'resiembras'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'aquaponic_system_id' => 'required|exists:aquaponic_systems,id',
            'resowing_id' => 'required|exists:resowings,id',
            'date' => 'required|date',
            'plant_count' => 'required|integer|min:0',
            'color_tone' => 'required|string',
            'height_cm' => 'required|numeric|min:0',
            'days_elapsed' => 'required|integer|min:0',
            'growth' => 'nullable|numeric|min:0',
            'mortality' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:255',
        ]);

        // Obtener la resiembra
        $resowing = Resowing::with('lots')->findOrFail($request->resowing_id);
        $totalQuantity = $resowing->total_quantity;

        // Validar plant_count
        if ($validated['plant_count'] > $totalQuantity) {
            return redirect()->back()->withInput()->with('error', 'El número de plantas no puede exceder la cantidad resembrada total (' . $totalQuantity . ').');
        }

        // Calcular days_elapsed
        $resowingDate = new \DateTime($resowing->date);
        $trackingDate = new \DateTime($request->date);
        $interval = $resowingDate->diff($trackingDate);
        $validated['days_elapsed'] = max(0, $interval->days);

        // Calcular valores para el primer seguimiento
        $previousTrackings = ResowingTracking::where('resowing_id', $request->resowing_id)->count();
        if ($previousTrackings === 0) {
            $validated['mortality'] = $totalQuantity - $validated['plant_count'];
            $validated['growth'] = $validated['height_cm'];
        } else {
            // Para seguimientos posteriores
            $previousTracking = ResowingTracking::where('resowing_id', $request->resowing_id)
                ->orderBy('date', 'desc')
                ->first();
            if ($previousTracking) {
                $validated['mortality'] = $previousTracking->plant_count - $validated['plant_count'];
                $validated['growth'] = $validated['height_cm'] - $previousTracking->height_cm;
            }
        }

        // Asegurar que los valores calculados sean válidos
        $validated['mortality'] = max(0, $validated['mortality']);
        $validated['growth'] = max(0, $validated['growth']);

        ResowingTracking::create($validated);

        $resowing->status = 'Seguimiento';
        $resowing->save();

        // Actualizar el estado de los lotes asociados a la resiembra
        foreach ($resowing->lots as $lot) {
            $lot->actualizarEstadoAutomatico(true);
        }

        return redirect()->back()->with('success', 'Seguimiento creado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'aquaponic_system_id' => 'required|exists:aquaponic_systems,id',
            'resowing_id' => 'required|exists:resowings,id',
            'date' => 'required|date',
            'plant_count' => 'required|integer|min:0',
            'color_tone' => 'required|string',
            'height_cm' => 'required|numeric|min:0',
            'days_elapsed' => 'nullable|integer|min:0',
            'growth' => 'nullable|numeric|min:0',
            'mortality' => 'nullable|integer|min:0',
            'notes' => 'nullable|string|max:255',
        ]);

        // Obtener la resiembra
        $resowing = Resowing::with('lots')->findOrFail($request->resowing_id);
        $totalQuantity = $resowing->total_quantity;

        // Validar plant_count
        if ($validated['plant_count'] > $totalQuantity) {
            return redirect()->back()->withInput()->with('error', 'El número de plantas no puede exceder la cantidad resembrada total (' . $totalQuantity . ').');
        }

        // Calcular days_elapsed
        $resowingDate = new \DateTime($resowing->date);
        $trackingDate = new \DateTime($request->date);
        $interval = $resowingDate->diff($trackingDate);
        $validated['days_elapsed'] = max(0, $interval->days);

        // Calcular valores derivados
        $previousTrackings = ResowingTracking::where('resowing_id', $request->resowing_id)
            ->where('id', '!=', $id)
            ->orderBy('date', 'desc')
            ->first();

        if (!$previousTrackings) {
            // Primer seguimiento
            $validated['mortality'] = $totalQuantity - $validated['plant_count'];
            $validated['growth'] = $validated['height_cm'];
        } else {
            // Seguimientos posteriores
            $validated['mortality'] = $previousTrackings->plant_count - $validated['plant_count'];
            $validated['growth'] = $validated['height_cm'] - $previousTrackings->height_cm;
        }

        // Asegurar que los valores calculados sean válidos
        $validated['mortality'] = max(0, $validated['mortality']);
        $validated['growth'] = max(0, $validated['growth']);

        $tracking = ResowingTracking::findOrFail($id);
        $tracking->update($validated);

        // Actualizar el estado de los lotes asociados a la resiembra
        foreach ($resowing->lots as $lot) {
            $lot->actualizarEstadoAutomatico(true);
        }

        return redirect()->back()->with('success', 'Seguimiento actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            $tracking = ResowingTracking::findOrFail($id);
            $resowingId = $tracking->resowing_id;

            $totalTrackings = ResowingTracking::where('resowing_id', $resowingId)->count();

            $tracking->delete();

            $resowing = Resowing::find($resowingId);
            if ($resowing) {
                if ($totalTrackings == 1) {
                    $resowing->status = 'Registrada';
                    $resowing->save();
                }

                // Actualizar el estado de los lotes asociados a la resiembra
                foreach ($resowing->lots as $lot) {
                    $lot->actualizarEstadoAutomatico(true);
                }
            } else {
                // Log or handle the case where resowing is not found
                \Log::warning("Resowing with ID {$resowingId} not found when deleting ResowingTracking ID {$id}");
            }

            return redirect()->back()->with('success', 'Seguimiento eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'No se puede eliminar este seguimiento porque está relacionado con otro registro.');
            }
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar el seguimiento.');
        }
    }

    public function getPreviousTracking($resowingId)
    {
        $previousTracking = ResowingTracking::where('resowing_id', $resowingId)
            ->orderBy('date', 'desc')
            ->first();

        $resowing = Resowing::with('lots')->findOrFail($resowingId);

        return response()->json([
            'previousTracking' => $previousTracking ? [
                'height_cm' => $previousTracking->height_cm,
                'plant_count' => $previousTracking->plant_count,
            ] : null,
            'total_quantity' => $resowing->total_quantity,
        ]);
    }
}
