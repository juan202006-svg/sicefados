<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\CropAquaponic;
use Modules\ACUAPONICO\Entities\Tracking;
use Modules\AGROCEFA\Entities\Crop;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()

    {
        $cultivos = CropAquaponic::with('species')->get();
        $seguimientos = Tracking::with('crops.species')->get();
        return view('acuaponico::pasante.seguimiento', compact('seguimientos', 'cultivos')); 
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('acuaponico::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $date = $request->date;
        $crop_id = $request->crop_id;
        $days_elapsed = $request->days_elapsed;
        $notes = $request->notes;
      
        
        $sequimientos = new Tracking(); 
        $sequimientos->date = $date;
        $sequimientos->crop_id = $crop_id;  
        $sequimientos->days_elapsed = $days_elapsed;
        $sequimientos->notes = $notes;
        $sequimientos->save();

        return redirect()->back()->with('success', 'Especie generada correctamente.');
        return view('acuaponico::pasante.seguimiento');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('acuaponico::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('acuaponico::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
            
        $seguimientos = Tracking::findOrFail($id);
        $seguimientos->date = $request->input('date');
        $seguimientos->crop_id = $request->input('crop_id');
        $seguimientos->days_elapsed = $request->input('days_elapsed');
        $seguimientos->notes = $request->input('notes');
        $seguimientos->save();
        return redirect()->back()->with('success', 'Seguimiento actualizado correctamente.');
        return view('acuaponico::pasante.seguimiento');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $seguimientos = Tracking::findOrFail($id);
        $seguimientos->delete();
        return redirect()->back()->with('success', 'Seguimiento eliminado correctamente.');
        return view('acuaponico::pasante.seguimiento');
    }
}
