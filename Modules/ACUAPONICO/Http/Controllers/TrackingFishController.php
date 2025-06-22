<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Tracking;
use Modules\ACUAPONICO\Entities\TrackingFish;
use Illuminate\Database\QueryException;

class TrackingFishController extends Controller
{

    public function index()
    {
        $seguimientoPez = TrackingFish::with('Tracking.crops.species.category')->get();
        $seguimientos = Tracking::whereHas('crops.species.category', function ($query) {
            $query->where('name', 'Pez');
        })->with('crops.species')->get();

        return view('acuaponico::.pasante.seguimientoPeces', compact('seguimientoPez', 'seguimientos'));
    }



    public function store(Request $request)
    {
        $seguimientoPez = new TrackingFish();
        $seguimientoPez->tracking_id = $request->tracking_id;
        $seguimientoPez->fish_count = $request->fish_count;
        $seguimientoPez->weight_gr = $request->weight_gr;
        $seguimientoPez->biomass_gr = $request->biomass_gr;
        $seguimientoPez->weight_gain_gr = $request->weight_gain_gr;
        $seguimientoPez->mortality = $request->mortality;
        $seguimientoPez->save();
        return redirect()->back()->with('success', 'Seguimiento de pez creado exitosamente.');
        return view('acuaponico::pasante.seguimientoPeces');
    }

    public function update(Request $request, $id)
    {
        $sgpez = TrackingFish::findOrFail($id);
        $sgpez->tracking_id = $request->imput('tracking_id');
        $sgpez->fish_count = $request->input('fish_count');
        $sgpez->weight_gr = $request->input('weight_gr');
        $sgpez->biomass_gr = $request->input('biomass_gr');
        $sgpez->weight_gain_gr = $request->input('weight_gain_gr');
        $sgpez->mortality = $request->input('mortality');
        $sgpez->save();

        return redirect()->back()->with('success', 'Seguimineto pez Actualizado correctamente.');
        return view('acuaponico::pasante.seguimientoPeces');
    }


    public function destroy($id)
    {
        try {
            $seguimientoPez = TrackingFish::findOrFail($id);
            $seguimientoPez->delete();
            return redirect()->back()->with('success', 'Seguimiento de pez eliminado exitosamente.');
            return view('acuaponico::pasante.seguimientoPeces');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'No se puede eliminar este seguimiento de pez porque está relacionado con otro registro.');
            }
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar el seguimiento.');
        }
    }
}
