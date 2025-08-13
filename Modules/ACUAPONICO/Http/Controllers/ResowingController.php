<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\AGROCEFA\Entities\Crop;
use Modules\AGROCEFA\Entities\Specie;
use Modules\ACUAPONICO\Entities\Resowing;
use Illuminate\Support\Facades\DB;

class ResowingController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $acuaponico = AquaponicSystem::get();
        // Solo cultivos con especies que tengan categoría "Planta" en seguimiento
        $cultivos = Crop::where('status', 'Seguimiento')
            ->whereHas('species.category', function($query) {
                $query->where('name', 'Planta');
            })
            ->with(['species.category'])
            ->get();
        $resiembra = Resowing::with('crops.species', 'system', 'lots')->get();

        return view('acuaponico::pasante.resiembra', compact('resiembra', 'cultivos', 'acuaponico'));
    }


    public function store(Request $request)
    {
        
        $totalAssigned = array_sum($request->lots);
        $mortalidad = $request->original_mortality;
        if ($totalAssigned > $mortalidad) {
            return redirect()->back()->with('error', 'La suma de las cantidades asignadas a los lotes no puede superar la mortalidad registrada.');
        }

        $resowing = Resowing::create([
            'aquaponic_system_id' => $request->aquaponic_system_id,
            'crop_id' => $request->crop_id,
            'original_mortality' => $request->original_mortality,
            'description' => $request->description,
            'status' => $request->status,
            'date' => $request->date
        ]);

        // Guardar en la pivote
        foreach ($request->lots as $lotId => $quantity) {
            if ($quantity > 0) {
                $resowing->lots()->attach($lotId, ['quantity' => $quantity]);
            }
        }

        return redirect()->back()->with('success', 'Resiembra registrada correctamente.');
    }


    public function update(Request $request, $id)
    {
        // Validar que la suma de cantidades no exceda la mortalidad
        $totalAssigned = array_sum($request->lots);
        $mortalidad = $request->original_mortality;
        if ($totalAssigned > $mortalidad) {
            return redirect()->back()->with('error', 'La suma de las cantidades asignadas a los lotes no puede superar la mortalidad registrada.');
        }

        $resowing = Resowing::findOrFail($id);
        $resowing->update([
            'aquaponic_system_id' => $request->aquaponic_system_id,
            'crop_id' => $request->crop_id,
            'original_mortality' => $request->original_mortality,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        // Actualizar lotes relacionados
        $resowing->lots()->detach();
        if ($request->lots && is_array($request->lots)) {
            foreach ($request->lots as $lotId => $quantity) {
                if ($quantity > 0) {
                    $resowing->lots()->attach($lotId, ['quantity' => $quantity]);
                }
            }
        }

        return redirect()->back()->with('success', 'Resiembra actualizada correctamente.');
    }

    public function destroy($id)
    {
        try {
            $resowing = Resowing::findOrFail($id);
            
            // Eliminar relaciones en la tabla pivote
            $resowing->lots()->detach();
            
            // Eliminar la resiembra
            $resowing->delete();

            return redirect()->back()->with('success', 'Resiembra eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la resiembra: ' . $e->getMessage());
        }
    }
    public function getCropsBySystem($systemId)
    {
        try {
            // Solo obtener cultivos con especies que tengan categoría "Planta"
            $crops = Crop::where('aquaponic_system_id', $systemId)
                ->where('status', 'Seguimiento')
                ->whereHas('species.category', function($query) {
                    $query->where('name', 'Planta');
                })
                ->with(['species.category'])
                ->get();

            // Formatear la respuesta solo para plantas
            $formattedCrops = $crops->map(function($crop) {
                return [
                    'id' => $crop->id,
                    'date' => $crop->date,
                    'quantity' => $crop->quantity,
                    'status' => $crop->status,
                    'species' => [
                        'id' => $crop->species->id ?? null,
                        'name' => $crop->species->name ?? 'Planta sin nombre',
                        'category' => $crop->species->category->name ?? 'Sin categoría'
                    ]
                ];
            });

            \Log::info('Cultivos de plantas encontrados para sistema ' . $systemId . ': ', $formattedCrops->toArray());
            
            return response()->json($formattedCrops);
        } catch (\Exception $e) {
            \Log::error('Error en getCropsBySystem: ' . $e->getMessage() . ' - Línea: ' . $e->getLine() . ' - Archivo: ' . $e->getFile());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getCropDetails($cropId)
    {
        try {
            $crop = Crop::with('species')->findOrFail($cropId);

            // Solo calcular mortalidad para plantas
            $mortality = DB::table('trackings')
                ->join('trackingplant', 'trackings.id', '=', 'trackingplant.tracking_id')
                ->where('trackings.crop_id', $cropId)
                ->sum('trackingplant.mortality');

            // Lotes asociados al cultivo y su capacidad disponible
            $lots = DB::table('crop_lot')
                ->join('lots', 'crop_lot.lot_id', '=', 'lots.id')
                ->select(
                    'lots.id',
                    'lots.name',
                    'lots.capacity',
                    'crop_lot.planted_quantity',
                    DB::raw('GREATEST(0, lots.capacity - (
                        SELECT COALESCE(SUM(cl2.planted_quantity), 0)
                        FROM crop_lot cl2 
                        WHERE cl2.lot_id = lots.id
                    )) as available_capacity')
                )
                ->where('crop_lot.crop_id', $cropId)
                ->get();

            \Log::info('Detalles del cultivo de planta ' . $cropId . ': mortality=' . $mortality . ', lots=' . $lots->count());

            return response()->json([
                'mortality' => $mortality ?? 0,
                'lots' => $lots,
                'crop' => [
                    'id' => $crop->id,
                    'species_name' => $crop->species->name ?? 'Planta sin nombre',
                    'species_category' => 'planta',
                    'status' => $crop->status
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error en getCropDetails: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Obtiene los lotes de un cultivo específico para edición de resiembra
     */
    public function getCropLotsForEdit($cropId, $resowingId = null)
    {
        try {
            // Obtener mortalidad del cultivo
            $mortality = DB::table('trackings')
                ->join('trackingplant', 'trackings.id', '=', 'trackingplant.tracking_id')
                ->where('trackings.crop_id', $cropId)
                ->sum('trackingplant.mortality');

            // Si hay un resowingId, obtener todos los lotes del cultivo pero marcar los que están en la resiembra
            if ($resowingId) {
                // Obtener todos los lotes del cultivo
                $allLots = DB::table('crop_lot')
                    ->join('lots', 'crop_lot.lot_id', '=', 'lots.id')
                    ->select(
                        'lots.id',
                        'lots.name',
                        'lots.capacity',
                        'crop_lot.planted_quantity',
                        DB::raw('GREATEST(0, lots.capacity - (
                            SELECT COALESCE(SUM(cl2.planted_quantity), 0)
                            FROM crop_lot cl2 
                            WHERE cl2.lot_id = lots.id
                        )) as available_capacity')
                    )
                    ->where('crop_lot.crop_id', $cropId)
                    ->get();

                // Obtener los lotes de la resiembra específica
                $resowingLots = DB::table('resowing_lot')
                    ->where('resowing_id', $resowingId)
                    ->pluck('quantity', 'lot_id')
                    ->toArray();

                // Combinar la información
                $lots = $allLots->map(function($lot) use ($resowingLots) {
                    $lot->current_quantity = $resowingLots[$lot->id] ?? 0;
                    return $lot;
                });
            } else {
                // Obtener todos los lotes del cultivo
                $lots = DB::table('crop_lot')
                    ->join('lots', 'crop_lot.lot_id', '=', 'lots.id')
                    ->select(
                        'lots.id',
                        'lots.name',
                        'lots.capacity',
                        'crop_lot.planted_quantity',
                        DB::raw('GREATEST(0, lots.capacity - (
                            SELECT COALESCE(SUM(cl2.planted_quantity), 0)
                            FROM crop_lot cl2 
                            WHERE cl2.lot_id = lots.id
                        )) as available_capacity')
                    )
                    ->where('crop_lot.crop_id', $cropId)
                    ->get();
            }

            return response()->json([
                'mortality' => $mortality ?? 0,
                'lots' => $lots
            ]);
        } catch (\Exception $e) {
            \Log::error('Error en getCropLotsForEdit: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Retorna los datos completos de una resiembra para edición
     */
    public function getEditData($id)
    {
        try {
            $resowing = Resowing::with(['lots', 'crops.species', 'system'])->findOrFail($id);
            
            // Obtener cultivos del sistema acuapónico para el dropdown
            $cropsInSystem = Crop::where('aquaponic_system_id', $resowing->aquaponic_system_id)
                ->where('status', 'Seguimiento')
                ->whereHas('species.category', function($query) {
                    $query->where('name', 'Planta');
                })
                ->with(['species.category'])
                ->get();

            // Obtener mortalidad del cultivo actual
            $mortality = DB::table('trackings')
                ->join('trackingplant', 'trackings.id', '=', 'trackingplant.tracking_id')
                ->where('trackings.crop_id', $resowing->crop_id)
                ->sum('trackingplant.mortality');

            // Obtener todos los lotes del cultivo pero marcar los que están en la resiembra
            $allLots = DB::table('crop_lot')
                ->join('lots', 'crop_lot.lot_id', '=', 'lots.id')
                ->select(
                    'lots.id',
                    'lots.name',
                    'lots.capacity',
                    'crop_lot.planted_quantity',
                    DB::raw('GREATEST(0, lots.capacity - (
                        SELECT COALESCE(SUM(cl2.planted_quantity), 0)
                        FROM crop_lot cl2 
                        WHERE cl2.lot_id = lots.id
                    )) as available_capacity')
                )
                ->where('crop_lot.crop_id', $resowing->crop_id)
                ->get();

            // Obtener los lotes de la resiembra específica
            $resowingLots = DB::table('resowing_lot')
                ->where('resowing_id', $resowing->id)
                ->pluck('quantity', 'lot_id')
                ->toArray();

            // Combinar la información
            $resowingLots = $allLots->map(function($lot) use ($resowingLots) {
                $lot->current_quantity = $resowingLots[$lot->id] ?? 0;
                return $lot;
            });

            return response()->json([
                'resowing' => $resowing,
                'cropsInSystem' => $cropsInSystem,
                'mortality' => $mortality ?? 0,
                'resowingLots' => $resowingLots
            ]);
        } catch (\Exception $e) {
            \Log::error('Error en getEditData: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // Método temporal para debug
    public function debugCrops()
    {
        $allCrops = Crop::with(['species.category', 'aquaponicSystem'])->get();
        $seguimientoCrops = Crop::where('status', 'Seguimiento')->with(['species.category', 'aquaponicSystem'])->get();
        $plantaCrops = Crop::where('status', 'Seguimiento')
            ->whereHas('species.category', function($query) {
                $query->where('name', 'Planta');
            })
            ->with(['species.category', 'aquaponicSystem'])
            ->get();
        $aquaponicSystems = AquaponicSystem::get();
        
        // Verificar cultivo específico con problemas
        $problemCrop = Crop::with(['species.category'])->find(30);
        $cropSpeciesId = $problemCrop ? $problemCrop->species_id : null;
        $speciesExists = $cropSpeciesId ? Specie::with('category')->find($cropSpeciesId) : null;
        
        return response()->json([
            'total_crops' => $allCrops->count(),
            'crops_in_seguimiento' => $seguimientoCrops->count(),
            'crops_plantas_seguimiento' => $plantaCrops->count(),
            'aquaponic_systems' => $aquaponicSystems->count(),
            'debug_crop_30' => [
                'exists' => $problemCrop ? true : false,
                'species_id' => $cropSpeciesId,
                'species_exists' => $speciesExists ? true : false,
                'species_name' => $speciesExists ? $speciesExists->name : 'No existe',
                'category_name' => $speciesExists && $speciesExists->category ? $speciesExists->category->name : 'Sin categoría',
                'raw_data' => $problemCrop ? $problemCrop->toArray() : null
            ],
            'plantas_crops' => $plantaCrops->map(function($crop) {
                return [
                    'id' => $crop->id,
                    'species_id' => $crop->species_id,
                    'species_name' => $crop->species ? $crop->species->name : 'Relación rota',
                    'category_name' => $crop->species && $crop->species->category ? $crop->species->category->name : 'Sin categoría',
                    'status' => $crop->status,
                    'aquaponic_system_id' => $crop->aquaponic_system_id,
                    'aquaponic_system_name' => $crop->aquaponicSystem ? $crop->aquaponicSystem->name : 'Sin sistema'
                ];
            })
        ]);
    }
}
