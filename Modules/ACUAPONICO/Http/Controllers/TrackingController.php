<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\CropAquaponic;
use Modules\ACUAPONICO\Entities\Tracking;
use Illuminate\Database\QueryException;

class TrackingController extends Controller
{
  
    public function index()

    {
        $cultivos = CropAquaponic::with('species') ->where('status', 'Cultivado') ->get();
        $seguimientos = Tracking::with('crops.species')->get();
        return view('acuaponico::pasante.seguimiento', compact('seguimientos', 'cultivos')); 
    }

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

        $cultivo = CropAquaponic::findOrFail($request->crop_id);
        // Cambiar el estado del cultivo a 'en seguimiento'
        $cultivo->status = 'Seguimiento';
        $cultivo->save();

        return redirect()->back()->with('success', 'Especie generada correctamente.');
        return view('acuaponico::pasante.seguimiento');
    }

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

   
    public function destroy($id)
    {
       try{ $seguimientos = Tracking::findOrFail($id);
        $seguimientos->delete();
        return redirect()->back()->with('success', 'Seguimiento eliminado correctamente.');
       } catch (QueryException $e) {
            if ($e->getCode() == '23000') { 
                return redirect()->back()->with('error', 'No se puede eliminar este seguimiento porque está relacionado con otro registro.');
            }
            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar el seguimiento.');
        }
        
    }
}
