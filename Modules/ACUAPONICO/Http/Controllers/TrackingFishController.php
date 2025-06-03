<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Tracking;
use Modules\ACUAPONICO\Entities\TrackingFish;
use Mpdf\Tag\Tr;

class TrackingFishController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
{
    $seguimientoPez = TrackingFish::with('Tracking.crops.species.category')->get();
    $seguimientos = Tracking::whereHas('crops.species.category', function ($query) {
        $query->where('name', 'Pez');})->with('crops.species')->get();

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
        //
    }


    public function destroy($id)
    {
        //
    }
}
