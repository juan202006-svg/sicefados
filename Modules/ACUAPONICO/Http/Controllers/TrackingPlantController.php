<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Tracking;
use Modules\ACUAPONICO\Entities\TrackingPlant;
use Illuminate\Database\QueryException;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\AGROCEFA\Entities\Crop;

use Carbon\Carbon;

class TrackingPlantController extends Controller
{

    public function __construct()
    {
        // Establecer la zona horaria de Colombia
        Carbon::setLocale('es');
        date_default_timezone_set('America/Bogota');
    }

    public function index()
    {
        // Obtener la fecha actual en Colombia
        $hoy = Carbon::now('America/Bogota')->toDateString();

        // Seguimientos de plantas registrados hoy
        $seguimientos = Tracking::whereDate('date', $hoy)
            ->whereHas('crops.species.category', function ($query) {
                $query->where('name', 'Planta');
            })
            ->with('crops.species')
            ->get();

        // Seguimientos detallados con relaciones
        $seguimientoPlanta = TrackingPlant::whereHas('Tracking', function ($query) use ($hoy) {
            $query->whereDate('date', $hoy);
        })
            ->with('Tracking.crops.species.category')
            ->get();

        $aquaponicSystems = AquaponicSystem::all();
        return view('acuaponico::pasante.seguimientoPlanta', compact('seguimientoPlanta', 'seguimientos', 'aquaponicSystems'));
    }

    public function trackingPlants()
    {
        // Obtener la fecha actual en Colombia
        $hoy = Carbon::now('America/Bogota')->toDateString();

        // Seguimientos de plantas registrados hoy
        $seguimientos = Tracking::whereDate('date', $hoy)
            ->whereHas('crops.species.category', function ($query) {
                $query->where('name', 'Planta');
            })
            ->with('crops.species')
            ->get();

        // Seguimientos detallados con relaciones, filtrados por fecha de hoy
        $seguimientoPlanta = TrackingPlant::whereHas('Tracking', function ($query) use ($hoy) {
            $query->whereDate('date', $hoy);
        })
            ->with('Tracking.crops.species.category')
            ->get();

        $aquaponicSystems = AquaponicSystem::all();
        return view('acuaponico::admin.plantaseguimiento', compact('seguimientoPlanta', 'seguimientos', 'aquaponicSystems'));
    }

    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'tracking_id' => 'required|exists:trackings,id',
            'plant_count' => 'required|integer|min:0',
            'height_cm' => 'required|integer|min:0',
            'color_tone' => 'required|string|max:12',
            'growth' => 'nullable|string',
        ]);

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

        // Guardar
        $sg = new TrackingPlant();
        $sg->tracking_id = $request->tracking_id;
        $sg->plant_count = $request->plant_count;
        $sg->height_cm = $request->height_cm;
        $sg->color_tone = $request->color_tone;
        $sg->growth = $crecimiento;
        $sg->mortality = $mortalidad;
        $sg->save();

        // Actualizar el estado de los lotes asociados al cultivo
        $tracking = Tracking::find($request->tracking_id);
        $crop = Crop::find($tracking->crop_id);
        foreach ($crop->lotes as $lot) {
            $lot->actualizarEstadoAutomatico();
        }

        return redirect()->back()->with('success', 'Seguimiento de planta creado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'tracking_id' => 'required|exists:trackings,id',
            'plant_count' => 'required|integer|min:0',
            'height_cm' => 'required|integer|min:0',
            'color_tone' => 'required|string|max:12',
            'growth' => 'nullable|string',
        ]);

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

        // Actualizar
        $seguimientoPlanta = TrackingPlant::findOrFail($id);
        $seguimientoPlanta->tracking_id = $request->tracking_id;
        $seguimientoPlanta->plant_count = $request->plant_count;
        $seguimientoPlanta->height_cm = $request->height_cm;
        $seguimientoPlanta->color_tone = $request->color_tone;
        $seguimientoPlanta->growth = $crecimiento;
        $seguimientoPlanta->mortality = $mortalidad;
        $seguimientoPlanta->save();

        // Actualizar el estado de los lotes asociados al cultivo
        $tracking = Tracking::find($request->tracking_id);
        $crop = Crop::find($tracking->crop_id);
        foreach ($crop->lotes as $lot) {
            $lot->actualizarEstadoAutomatico();
        }

        return redirect()->back()->with('success', 'Seguimiento de planta actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            $seguimientos = TrackingPlant::findOrFail($id);
            $tracking_id = $seguimientos->tracking_id;
            $seguimientos->delete();

            // Actualizar el estado de los lotes asociados al cultivo
            $tracking = Tracking::find($tracking_id);
            $crop = Crop::find($tracking->crop_id);
            foreach ($crop->lotes as $lot) {
                $lot->actualizarEstadoAutomatico();
            }

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

    public function obtenerSeguimientos($aquaponic_system_id)
    {
        $hoy = Carbon::now('America/Bogota')->toDateString();
        $seguimientos = Tracking::where('aquaponic_system_id', $aquaponic_system_id)
            ->whereDate('date', $hoy)
            ->whereHas('crops.species.category', function ($query) {
                $query->where('name', 'Planta');
            })
            ->with('crops.species')
            ->get();
        return response()->json($seguimientos);
    }
}
