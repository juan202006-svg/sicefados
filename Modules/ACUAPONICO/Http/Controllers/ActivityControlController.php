<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\ActivityAquaponic;
use Modules\ACUAPONICO\Entities\ActivityControl;

class ActivityControlController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $activities = ActivityAquaponic::with('user')->where('enviada', true)->get();

        $evidencias = ActivityControl::with('activity')->get();

        return view('acuaponico::pasante.controlactividad', compact('activities', 'evidencias'));
    }


    public function store(Request $request)
    {
        $evidencePath = null;

        if ($request->hasFile('evidence')) {
            // 1. Subir archivo al disco 'public'
            $evidencePath = $request->file('evidence')->store('evidencias', 'public');

            // 2. Obtener ruta absoluta del archivo
            $fullPath = storage_path('app/public/' . $evidencePath);

            // 3. Asignar permisos 0644
            if (file_exists($fullPath)) {
                chmod($fullPath, 0644);
            }
        }

        // Guardar el registro en la base de datos
        $controlActividad = new ActivityControl();
        $controlActividad->activity_id = $request->activity_id;
        $controlActividad->date = $request->date;
        $controlActividad->news = $request->news;
        $controlActividad->evidence = $evidencePath;
        $controlActividad->save();

        return redirect()->back()->with('success', 'Evidencia registrada exitosamente.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
