<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Tracking;
use Modules\ACUAPONICO\Entities\TrackingFish;
use Illuminate\Database\QueryException;

class TrackingFishController extends Controller
{
    public function index()
    {
        // Trae todos los seguimientos de peces con relaciones
        $seguimientoPez = TrackingFish::with('Tracking.crops.species.category')->get();

        // Trae todos los cultivos de peces con su último seguimiento
        $seguimientos = Tracking::whereHas('crops.species.category', function ($query) {
            $query->where('name', 'Pez');
        })
            ->with(['crops.species', 'latestFishTracking']) // cargamos el último seguimiento de peces
            ->get();

        return view('acuaponico::.pasante.seguimientoPeces', compact('seguimientoPez', 'seguimientos'));
    }

    public function store(Request $request)
    {
        $pesoActual = $request->weight_gr;
        $cantidadActual = $request->fish_count;

        // Buscar el tracking actual y su cultivo
        $trackingActual = Tracking::with('crops')->findOrFail($request->tracking_id);
        $cropId = $trackingActual->crop_id;

        // Buscar el tracking anterior del mismo cultivo
        $trackingAnterior = Tracking::where('crop_id', $cropId)
            ->where('id', '<', $trackingActual->id)
            ->orderBy('id', 'desc')
            ->first();

        if ($trackingAnterior) {
            // Buscar el último seguimiento de peces en ese tracking anterior
            $ultimo = TrackingFish::where('tracking_id', $trackingAnterior->id)
                ->orderBy('id', 'desc')
                ->first();
        } else {
            $ultimo = null;
        }

        if ($ultimo) {
            $pecesAnteriores = $ultimo->fish_count;
            $pesoAnterior = $ultimo->weight_gr;
        } else {
            // Si no hay seguimiento anterior, usar la cantidad original del cultivo
            $pecesAnteriores = $trackingActual->crops->quantity;
            $pesoAnterior = 0;
        }

        // Cálculos
        $ganancia = $pesoActual - $pesoAnterior;
        $biomasa = $pesoActual * $cantidadActual;
        $mortalidad = $pecesAnteriores - $cantidadActual;

        // Guardar seguimiento
        $seguimiento = new TrackingFish();
        $seguimiento->tracking_id = $request->tracking_id;
        $seguimiento->fish_count = $cantidadActual;
        $seguimiento->weight_gr = $pesoActual;
        $seguimiento->weight_gain_gr = $ganancia;
        $seguimiento->biomass_gr = $biomasa;
        $seguimiento->mortality = $mortalidad;
        $seguimiento->save();

        return redirect()->back()->with('success', 'Seguimiento de peces registrado correctamente.');
    }

    public function update(Request $request, $id)
    {
        $seguimiento = TrackingFish::findOrFail($id);
        $pesoActual = $request->input('weight_gr');
        $cantidadActual = $request->input('fish_count');

        // Obtener el tracking actual y su crop_id
        $trackingActual = Tracking::with('crops')->findOrFail($request->input('tracking_id'));
        $cropId = $trackingActual->crop_id;

        // Buscar el tracking anterior del mismo cultivo
        $trackingAnterior = Tracking::where('crop_id', $cropId)
            ->where('id', '<', $trackingActual->id)
            ->orderBy('id', 'desc')
            ->first();

        // Buscar seguimiento anterior (que no sea el actual)
        if ($trackingAnterior) {
            $seguimientoAnterior = TrackingFish::where('tracking_id', $trackingAnterior->id)
                ->orderBy('id', 'desc')
                ->first();
        } else {
            $seguimientoAnterior = null;
        }

        if ($seguimientoAnterior) {
            $pecesAnteriores = $seguimientoAnterior->fish_count;
            $pesoAnterior = $seguimientoAnterior->weight_gr;
        } else {
            $pecesAnteriores = $trackingActual->crops->quantity;
            $pesoAnterior = 0;
        }

        // Cálculos actualizados
        $seguimiento->tracking_id = $request->input('tracking_id');
        $seguimiento->fish_count = $cantidadActual;
        $seguimiento->weight_gr = $pesoActual;
        $seguimiento->biomass_gr = $pesoActual * $cantidadActual;
        $seguimiento->weight_gain_gr = $pesoActual - $pesoAnterior;
        $seguimiento->mortality = $pecesAnteriores - $cantidadActual;
        $seguimiento->save();

        return redirect()->back()->with('success', 'Seguimiento de peces actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            $seguimientoPez = TrackingFish::findOrFail($id);
            $seguimientoPez->delete();
            return redirect()->back()->with('success', 'Seguimiento de pez eliminado exitosamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'No se puede eliminar este seguimiento de pez porque está relacionado con otro registro.');
            }
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar el seguimiento.');
        }
    }


    public function getPreviousFishData($trackingId)
    {
        $trackingActual = Tracking::with('crops')->findOrFail($trackingId);
        $cropId = $trackingActual->crop_id;

        // Buscar el tracking anterior del mismo cultivo
        $trackingAnterior = Tracking::where('crop_id', $cropId)
            ->where('id', '<', $trackingActual->id)
            ->orderBy('id', 'desc')
            ->first();

        $peces = 0;
        $peso = 0;

        if ($trackingAnterior) {
            $seguimientoAnterior = TrackingFish::where('tracking_id', $trackingAnterior->id)
                ->orderBy('id', 'desc')
                ->first();

            if ($seguimientoAnterior) {
                $peces = $seguimientoAnterior->fish_count;
                $peso = $seguimientoAnterior->weight_gr;
            }
        } else {
            $peces = $trackingActual->crops->quantity;
        }

        return response()->json([
            'peces' => $peces,
            'peso' => $peso,
        ]);
    }
}
