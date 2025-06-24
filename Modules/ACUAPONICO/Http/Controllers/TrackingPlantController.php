<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Tracking;
use Modules\ACUAPONICO\Entities\TrackingPlant;
use Illuminate\Database\QueryException;

class TrackingPlantController extends Controller
{
    public function index()
    {
        $seguimientoPlanta = TrackingPlant::with('Tracking.crops.species.category')->get();
        $seguimientos = Tracking::whereHas('crops.species.category', function ($query) {
            $query->where('name', 'Planta');
        })->with('crops.species')->get();

        return view('acuaponico::pasante.seguimientoPlanta', compact('seguimientoPlanta', 'seguimientos'));
    }

    public function store(Request $request)
    {
        // Buscar seguimiento anterior
        $anterior = TrackingPlant::where('tracking_id', $request->tracking_id)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$anterior) {
            $tracking = Tracking::with('crops')->find($request->tracking_id);
            $plantas_anteriores = $tracking?->crops?->quantity ?? 0;
            $altura_anterior = 0;
        } else {
            $plantas_anteriores = $anterior->plant_count;
            $altura_anterior = $anterior->height_cm;
        }

        // Calcular
        $mortalidad = max(0, $plantas_anteriores - $request->plant_count);
        $crecimiento = $request->height_cm - $altura_anterior;
        $rendimiento = ($altura_anterior > 0)
            ? ($request->height_cm / $altura_anterior) * 100
            : 0;

        // Guardar
        $sg = new TrackingPlant();
        $sg->tracking_id = $request->tracking_id;
        $sg->plant_count = $request->plant_count;
        $sg->height_cm = $request->height_cm;
        $sg->growth = $crecimiento;
        $sg->comparison_percentage = $rendimiento;
        $sg->mortality = $mortalidad;
        $sg->save();

        return redirect()->back()->with('success', 'Seguimiento de planta creado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        // Buscar seguimiento anterior que no sea este mismo
        $anterior = TrackingPlant::where('tracking_id', $request->tracking_id)
            ->where('id', '!=', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$anterior) {
            $tracking = Tracking::with('crops')->find($request->tracking_id);
            $plantas_anteriores = $tracking?->crops?->quantity ?? 0;
            $altura_anterior = 0;
        } else {
            $plantas_anteriores = $anterior->plant_count;
            $altura_anterior = $anterior->height_cm;
        }

        // Calcular
        $mortalidad = max(0, $plantas_anteriores - $request->plant_count);
        $crecimiento = $request->height_cm - $altura_anterior;
        $rendimiento = ($altura_anterior > 0)
            ? ($request->height_cm / $altura_anterior) * 100
            : 0;

        // Actualizar
        $seguimientoPlanta = TrackingPlant::findOrFail($id);
        $seguimientoPlanta->tracking_id = $request->tracking_id;
        $seguimientoPlanta->plant_count = $request->plant_count;
        $seguimientoPlanta->height_cm = $request->height_cm;
        $seguimientoPlanta->growth = $crecimiento;
        $seguimientoPlanta->comparison_percentage = $rendimiento;
        $seguimientoPlanta->mortality = $mortalidad;
        $seguimientoPlanta->save();

        return redirect()->back()->with('success', 'Seguimiento de planta actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            $seguimientos = TrackingPlant::findOrFail($id);
            $seguimientos->delete();

            return redirect()->back()->with('success', 'Seguimiento de planta eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'No se puede eliminar este seguimiento de planta porque está relacionado con otro registro.');
            }
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar el seguimiento de planta.');
        }
    }
    public function obtenerDatosAnteriores($tracking_id)
    {
        $anterior = TrackingPlant::where('tracking_id', $tracking_id)
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$anterior) {
            $tracking = Tracking::with('crops')->find($tracking_id);
            return response()->json([
                'plantas' => $tracking?->crops?->quantity ?? 0,
                'altura' => 0
            ]);
        }

        return response()->json([
            'plantas' => $anterior->plant_count,
            'altura' => $anterior->height_cm
        ]);
    }
}
