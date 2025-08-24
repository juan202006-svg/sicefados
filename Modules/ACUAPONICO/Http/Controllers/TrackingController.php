<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\Tracking;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Illuminate\Database\QueryException;

class TrackingController extends Controller
{

    public function index()
    {

        $acuaponicos = AquaponicSystem::get();
        $cultivos = Crop::with('species')->whereIn('status', ['Cultivado', 'Seguimiento'])->get();
        $seguimientos = Tracking::with('crops.species', 'crops.aquaponicSystem')->get();
        return view('acuaponico::pasante.seguimiento', compact('seguimientos', 'cultivos', 'acuaponicos'));

    }

    public function General()
    {

        $acuaponicos = AquaponicSystem::get();
        $cultivos = Crop::with('species')->whereIn('status', ['Cultivado', 'Seguimiento'])->get();
        $seguimientos = Tracking::with('crops.species', 'crops.aquaponicSystem')->get();
        return view('acuaponico::admin.seguimientogeneral', compact('seguimientos', 'cultivos', 'acuaponicos'));

    }

    public function store(Request $request)
    {
        $date = $request->date;
        $crop_id = $request->crop_id;
        $days_elapsed = $request->days_elapsed;
        $notes = $request->notes;


        $sequimientos = new Tracking();
        $sequimientos->date = $date;
        $sequimientos->aquaponic_system_id = $request->aquaponic_system_id; // Asegúrate de que este campo exista en tu formulario
        $sequimientos->crop_id = $crop_id;
        $sequimientos->days_elapsed = $days_elapsed;
        $sequimientos->notes = $notes;
        $sequimientos->save();

        $cultivo = Crop::findOrFail($request->crop_id);
        // Cambiar el estado del cultivo a 'en seguimiento'
        $cultivo->status = 'Seguimiento';
        $cultivo->save();

        return redirect()->back()->with('success', 'Especie generada correctamente.');
        return view('acuaponico::pasante.seguimiento');
    }

    public function update(Request $request, $id)
    {

        $seguimientos = Tracking::findOrFail($id);
        $seguimientos->aquaponic_system_id = $request->input('aquaponic_system_id');
        $seguimientos->crop_id = $request->input('crop_id');
        $seguimientos->days_elapsed = $request->input('days_elapsed');
        $seguimientos->notes = $request->input('notes');
        $seguimientos->save();
        return redirect()->back()->with('success', 'Seguimiento actualizado correctamente.');
        return view('acuaponico::pasante.seguimiento');
    }


    public function destroy($id)
    {
        try {
            $seguimiento = Tracking::findOrFail($id);
            $cropId = $seguimiento->crop_id;

            // Contar cuántos seguimientos existen para ese cultivo
            $totalSeguimientos = Tracking::where('crop_id', $cropId)->count();

            // Eliminar el seguimiento
            $seguimiento->delete();

            // Si solo había uno (el que acabamos de eliminar), entonces cambiar estado a 'Cultivado'
            if ($totalSeguimientos == 1) {
                $cultivo = Crop::find($cropId);
                if ($cultivo) {
                    $cultivo->status = 'Cultivado';
                    $cultivo->save();
                }
            }

            return redirect()->back()->with('success', 'Seguimiento eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'No se puede eliminar este seguimiento porque está relacionado con otro registro.');
            }
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar el seguimiento.');
        }
    }
}