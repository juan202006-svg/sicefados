<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Lot;

class LotController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $lots = Lot::get();
        return view('acuaponico::pasante.index')->with(['lots' => $lots]);
        
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
        
    
        $lot = new Lot();
        $lot->date = $request->date;
        $lot->name = $request->name;
        $lot->capacity = $request->capacity;
        $lot->state = $request->state;
        $lot->save();
    
        return redirect()->back()->with('success', 'Lote generado correctamente.');
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
        $lot = Lot::findOrFail($id);
        $lot->update($request->all());
        return redirect()->route('acuaponico.pasante.pasante.index')->with('success', 'Lote actualizado correctamente.');
    }
    
    
    
    

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $lot = Lot::findOrFail($id);
        $lot->delete();

        return redirect()->back()->with('success', 'Lote eliminado correctamente.');
    }
}
