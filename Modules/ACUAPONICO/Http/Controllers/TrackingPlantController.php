<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
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
        $sg = new TrackingPlant();
        $sg->tracking_id = $request->tracking_id;
        $sg->plant_count = $request->plant_count;
        $sg->height_cm = $request->height_cm;
        $sg->growth = $request->growth;
        $sg->comparison_percentage = $request->comparison_percentage;
        $sg->mortality = $request->mortality;
        $sg->save();

        return redirect()->back()->with('success', 'Seguimiento de planta creado exitosamente.');
        return view('acuaponico::pasante.seguimientoPlanta');
    }

    public function update(Request $request, $id)
    {
        $seguimientoPlanta = TrackingPlant::findOrFail($id);
        $seguimientoPlanta->tracking_id = $request->input('tracking_id');
        $seguimientoPlanta->plant_count = $request->input('plant_count');
        $seguimientoPlanta->height_cm = $request->input('height_cm');
        $seguimientoPlanta->growth = $request->input('growth');
        $seguimientoPlanta->comparison_percentage = $request->input('comparison_percentage');
        $seguimientoPlanta->mortality = $request->input('mortality');
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
}
