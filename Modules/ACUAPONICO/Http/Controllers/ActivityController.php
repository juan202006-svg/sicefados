<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\ActivityAquaponic;
use Modules\ACUAPONICO\Entities\UserAquaponic;

class ActivityController extends Controller
{

    public function index()
    {
        $activities = ActivityAquaponic::with('user')->where('enviada', false)->get();
        $users = UserAquaponic::all();
        return view('acuaponico::admin.actividades', compact('activities', 'users'));
    }

    public function enviados()
    {
        $activities = ActivityAquaponic::with('user')->where('enviada', true)->get();
        return view('', compact('activities'));
    }


    public function create()
    {
        return view('acuaponico::create');
    }


    public function store(Request $request)
    {
        ActivityAquaponic::create($request->all());

        return redirect()->back()->with('success', 'Actividad creada correctamente');
    }


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


    public function update(Request $request, $id)
    {
        $activity = ActivityAquaponic::findOrFail($id);
        $activity->update($request->all());

        return redirect()->back()->with('success', 'Actividad actualizada');
    }


    public function destroy($id)
    {
        ActivityAquaponic::destroy($id);

        return redirect()->back()->with('success', 'Actividad eliminada');
    }

    public function enviar($id)
    {
        $activity = ActivityAquaponic::findOrFail($id);
        $activity->update(['enviada' => true]);

        return redirect()->back()->with('success', 'Actividad enviada');
    }
}
