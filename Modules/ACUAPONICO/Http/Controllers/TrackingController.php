<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\Tracking;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\ACUAPONICO\Entities\Resowing;
use Illuminate\Database\QueryException;

class TrackingController extends Controller
{

    public function index()
    {
        try {
            $acuaponicos = AquaponicSystem::get();
            $cultivos = Crop::with('species')->whereIn('status', ['Cultivado', 'Seguimiento'])->get();
            
            // Cargar seguimientos con relaciones más específicas
            $seguimientos = Tracking::with([
                'crops.species', 
                'crops.aquaponicSystem',
                'subject.crops.species', // Para resiembras
                'subject.species' // Para cultivos
            ])->get();
            
            return view('acuaponico::pasante.seguimiento', compact('seguimientos', 'cultivos', 'acuaponicos'));
        } catch (\Exception $e) {
            \Log::error('Error en TrackingController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cargar los seguimientos: ' . $e->getMessage());
        }
    }

    public function getCropsBySystem($systemId)
    {
        $result = [];
        
        try {
            // 1. Cultivos del sistema en estado 'Seguimiento' o 'Cultivado'
            $crops = Crop::where('aquaponic_system_id', $systemId)
                ->whereIn('status', ['Seguimiento', 'Cultivado']) // Filtro por ambos estados
                ->whereHas('species') // Solo cultivos que tengan especie
                ->with(['species.category'])
                ->get();

            foreach($crops as $crop) {
                // Validar que existan todos los datos necesarios
                if ($crop->species && $crop->species->name) {
                    $result[] = [
                        'id' => $crop->id,
                        'name' => $crop->species->name,
                        'type' => 'crop',
                        'category' => $crop->species->category ? $crop->species->category->name : 'Sin categoría',
                        'subject_type' => 'crop',
                        'subject_id' => $crop->id,
                        'display_name' => $crop->species->name . ' (Cultivo - ' . $crop->status . ')',
                        'status' => $crop->status ?: 'Cultivado'
                    ];
                }
            }
            
            // 2. Resiembras del sistema en estado 'Registrada' o 'Seguimiento'
            $resowings = Resowing::where('aquaponic_system_id', $systemId)
                ->whereIn('status', ['Registrada', 'Seguimiento']) // Filtro por ambos estados
                ->whereHas('crops.species') // Solo resiembras que tengan cultivo con especie
                ->with(['crops.species.category'])
                ->get();

            foreach($resowings as $resowing) {
                // Validar que existan todos los datos necesarios
                if ($resowing->crops && $resowing->crops->species && $resowing->crops->species->name) {
                    $result[] = [
                        'id' => $resowing->crop_id,
                        'name' => $resowing->crops->species->name,
                        'type' => 'resowing',
                        'category' => $resowing->crops->species->category ? $resowing->crops->species->category->name : 'Sin categoría',
                        'subject_type' => 'resowing',
                        'subject_id' => $resowing->id,
                        'display_name' => $resowing->crops->species->name . ' (Resiembra - ' . $resowing->status . ')',
                        'status' => $resowing->status ?: 'Registrada'
                    ];
                }
            }

            // Ordenar por tipo y luego por nombre
            usort($result, function($a, $b) {
                if ($a['type'] !== $b['type']) {
                    return $a['type'] === 'crop' ? -1 : 1; // Cultivos primero
                }
                return strcmp($a['name'], $b['name']);
            });

            return response()->json([
                'success' => true,
                'data' => $result,
                'count' => count($result),
                'system_id' => $systemId
            ]);

        } catch (\Exception $e) {
            \Log::error('Error en getCropsBySystem: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar los datos',
                'data' => [],
                'count' => 0
            ], 500);
        }
    }

    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'aquaponic_system_id' => 'required|exists:aquaponic_systems,id',
            'subject_type' => 'required|in:crop,resowing',
            'subject_id' => 'required|integer',
            'date' => 'required|date',
            'days_elapsed' => 'required|integer|min:0',
            'notes' => 'nullable|string'
        ]);

        // Crear el seguimiento
        $tracking = new Tracking();
        $tracking->date = $request->date;
        $tracking->aquaponic_system_id = $request->aquaponic_system_id;
        $tracking->subject_type = $request->subject_type;
        $tracking->subject_id = $request->subject_id;
        $tracking->days_elapsed = $request->days_elapsed;
        $tracking->notes = $request->notes;
        $tracking->save();

        // Si es un cultivo, cambiar estado a 'Seguimiento'
        if ($request->subject_type === 'crop') {
            $cultivo = Crop::findOrFail($request->subject_id);
            $cultivo->status = 'Seguimiento';
            $cultivo->save();
        }

        return redirect()->back()->with('success', 'Seguimiento registrado correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'aquaponic_system_id' => 'required|exists:aquaponic_systems,id',
            'subject_type' => 'required|in:crop,resowing',
            'subject_id' => 'required|integer',
            'days_elapsed' => 'required|integer|min:0',
            'notes' => 'nullable|string'
        ]);

        $seguimiento = Tracking::findOrFail($id);
        $seguimiento->aquaponic_system_id = $request->input('aquaponic_system_id');
        $seguimiento->subject_type = $request->input('subject_type');
        $seguimiento->subject_id = $request->input('subject_id');
        $seguimiento->days_elapsed = $request->input('days_elapsed');
        $seguimiento->notes = $request->input('notes');
        $seguimiento->save();
        
        return redirect()->back()->with('success', 'Seguimiento actualizado correctamente.');
    }


    public function destroy($id)
    {
        try {
            $seguimiento = Tracking::findOrFail($id);
            $subjectType = $seguimiento->subject_type;
            $subjectId = $seguimiento->subject_id;

            // Contar cuántos seguimientos existen para ese sujeto
            $totalSeguimientos = Tracking::where('subject_type', $subjectType)
                ->where('subject_id', $subjectId)
                ->count();

            // Eliminar el seguimiento
            $seguimiento->delete();

            // Si solo había uno (el que acabamos de eliminar), entonces cambiar estado
            if ($totalSeguimientos == 1) {
                if ($subjectType === 'crop') {
                    $cultivo = Crop::find($subjectId);
                    if ($cultivo) {
                        $cultivo->status = 'Cultivado';
                        $cultivo->save();
                    }
                } elseif ($subjectType === 'resowing') {
                    $resowing = Resowing::find($subjectId);
                    if ($resowing) {
                        $resowing->status = 'Registrada';
                        $resowing->save();
                    }
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
