<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\ActivityAquaponic;
use Modules\ACUAPONICO\Entities\UserAquaponic;
use Modules\ACUAPONICO\Entities\ActivityControl;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = ActivityAquaponic::with('user')->where('enviada', false)->get();
        $users = UserAquaponic::all();
        $evidenciasAdmin = ActivityControl::with('activity')->get();
        return view('acuaponico::admin.actividades', compact('activities', 'users', 'evidenciasAdmin'));
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


    public function descargarEvidencia($id)
    {
        $evidencia = ActivityControl::with('activity')->findOrFail($id);

        if ($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence)) {
            // Nombre personalizado: ejemplo "evidencia-filtro-de-agua-25.pdf"
            $nombreActividad = Str::slug($evidencia->activity->activity_name); // elimina espacios y caracteres raros
            $nombreArchivo = '(SA)🐟 evidencia-' . $nombreActividad . '-' . $evidencia->id . '.pdf';

            return Storage::disk('public')->download($evidencia->evidence, $nombreArchivo);
        } else {
            abort(404, 'Archivo no encontrado');
        }
    }

    public function verEvidencia($id)
    {
        $evidencia = ActivityControl::findOrFail($id);

        if ($evidencia->evidence && Storage::disk('public')->exists($evidencia->evidence)) {
            $file = Storage::disk('public')->get($evidencia->evidence);
            return response($file, 200)
                ->header('Content-Type', 'application/pdf');
        } else {
            abort(404, 'Archivo no encontrado');
        }
    }
}
