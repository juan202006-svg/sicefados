<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\AGROCEFA\Entities\Crop;
use Modules\AGROCEFA\Entities\Specie;
use Modules\ACUAPONICO\Entities\Resowing;
use Modules\ACUAPONICO\Entities\Lot;
use Illuminate\Support\Facades\DB;

class ResowingController extends Controller
{
    public function index()
    {
        $acuaponico = AquaponicSystem::get();
        $cultivos = Crop::where('status', 'Seguimiento')
            ->whereHas('species.category', function ($query) {
                $query->where('name', 'Planta');
            })
            ->with(['species.category'])
            ->get();
        $resiembra = Resowing::with('crops.species', 'system', 'lots')->get();

        return view('acuaponico::pasante.resiembra', compact('resiembra', 'cultivos', 'acuaponico'));
    }


        public function registroResiembras  ()
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

        return view('acuaponico::admin.registroresiembras', compact('resiembra', 'cultivos', 'acuaponico'));
    }


    public function store(Request $request)
    {
        // Validar datos
        $request->validate([
            'aquaponic_system_id' => 'required|exists:aquaponic_systems,id',
            'crop_id' => 'required|exists:crops,id',
            'original_mortality' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'date' => 'required|date',
            'lots' => 'required|array',
            'lots.*' => 'integer|min:0',
        ]);

        // Validar si el cultivo ya tiene una resiembra
        if (Resowing::where('crop_id', $request->crop_id)->exists()) {
            return redirect()->back()->withInput()->with('error', 'Este cultivo ya tiene una resiembra registrada.');
        }

        // Validar que la suma de cantidades no exceda la mortalidad
        $totalAssigned = array_sum($request->lots);
        if ($totalAssigned > $request->original_mortality) {
            return redirect()->back()->withInput()->with('error', 'La suma de las cantidades asignadas a los lotes no puede superar la mortalidad registrada.');
        }

        // Validar que las cantidades no excedan las unidades disponibles
        $errors = [];
        foreach ($request->lots as $lotId => $quantity) {
            if ($quantity > 0) {
                $lot = Lot::findOrFail($lotId);
                if ($quantity > $lot->disponible) {
                    $errors[] = "El lote {$lot->name} no tiene suficientes unidades disponibles (máximo: {$lot->disponible}).";
                }
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $errors));
        }

        // Crear la resiembra
        $resowing = Resowing::create([
            'aquaponic_system_id' => $request->aquaponic_system_id,
            'crop_id' => $request->crop_id,
            'original_mortality' => $request->original_mortality,
            'description' => $request->description,
            'status' => $request->status,
            'date' => $request->date
        ]);

        // Guardar en la tabla pivote y actualizar estados de lotes
        foreach ($request->lots as $lotId => $quantity) {
            if ($quantity > 0) {
                $resowing->lots()->attach($lotId, ['quantity' => $quantity]);
                $lot = Lot::find($lotId);
                $lot->actualizarEstadoAutomatico(true); // Actualizar estado del lote
            }
        }

        return redirect()->back()->with('success', 'Resiembra registrada correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'aquaponic_system_id' => 'required|exists:aquaponic_systems,id',
            'crop_id' => 'required|exists:crops,id',
            'original_mortality' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'lots' => 'required|array',
            'lots.*' => 'integer|min:0',
        ]);

        $resowing = Resowing::findOrFail($id);

        // Validar si se cambia a un cultivo que ya tiene resiembra (excepto el actual)
        if ($request->crop_id != $resowing->crop_id && Resowing::where('crop_id', $request->crop_id)->exists()) {
            return redirect()->back()->withInput()->with('error', 'Este cultivo ya tiene una resiembra registrada.');
        }

        // Validar que la suma de cantidades no exceda la mortalidad
        $totalAssigned = array_sum($request->lots);
        if ($totalAssigned > $request->original_mortality) {
            return redirect()->back()->withInput()->with('error', 'La suma de las cantidades asignadas a los lotes no puede superar la mortalidad registrada.');
        }

        // Validar que las cantidades no excedan las unidades disponibles
        $errors = [];
        foreach ($request->lots as $lotId => $quantity) {
            if ($quantity > 0) {
                $lot = Lot::findOrFail($lotId);
                // Obtener la cantidad ya asignada a este lote en la resiembra (si existe)
                $existingQuantity = DB::table('resowing_lot')
                    ->where('resowing_id', $id)
                    ->where('lot_id', $lotId)
                    ->value('quantity') ?? 0;
                // Calcular unidades disponibles considerando la cantidad que se liberará
                $availableAfterDetach = $lot->disponible + $existingQuantity;
                if ($quantity > $availableAfterDetach) {
                    $errors[] = "El lote {$lot->name} no tiene suficientes unidades disponibles (máximo: {$availableAfterDetach}).";
                }
            }
        }

        if (!empty($errors)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $errors));
        }

        // Actualizar la resiembra
        $resowing->update([
            'aquaponic_system_id' => $request->aquaponic_system_id,
            'crop_id' => $request->crop_id,
            'original_mortality' => $request->original_mortality,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        // Actualizar lotes relacionados
        $resowing->lots()->detach(); // Eliminar todas las asignaciones previas
        foreach ($request->lots as $lotId => $quantity) {
            if ($quantity > 0) {
                $resowing->lots()->attach($lotId, ['quantity' => $quantity]);
                $lot = Lot::find($lotId);
                $lot->actualizarEstadoAutomatico(true); // Actualizar estado del lote
            }
        }

        return redirect()->back()->with('success', 'Resiembra actualizada correctamente.');
    }

    public function destroy($id)
    {
        try {
            $resowing = Resowing::findOrFail($id);
            $lotIds = $resowing->lots()->pluck('lot_id')->toArray(); // Obtener IDs de lotes relacionados
            $resowing->lots()->detach(); // Eliminar relaciones en la tabla pivote
            $resowing->delete(); // Eliminar la resiembra

            // Actualizar el estado de los lotes afectados
            foreach ($lotIds as $lotId) {
                $lot = Lot::find($lotId);
                if ($lot) {
                    $lot->actualizarEstadoAutomatico(true);
                }
            }

            return redirect()->back()->with('success', 'Resiembra eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la resiembra: ' . $e->getMessage());
        }
    }

    public function getCropsBySystem($systemId, $resowingId = null)
    {
        try {
            $query = Crop::where('aquaponic_system_id', $systemId)
                ->where('status', 'Seguimiento')
                ->whereHas('species.category', function ($query) {
                    $query->where('name', 'Planta');
                })
                ->with(['species.category', 'trackings.trackingPlants']);

            if ($resowingId) {
                // En modo edición: Excluir resiembras excepto la actual
                $query->whereDoesntHave('resowings', function ($q) use ($resowingId) {
                    $q->where('id', '!=', $resowingId);
                });
            } else {
                // Modo agregar: Excluir todos con resiembras
                $query->whereDoesntHave('resowings');
            }

            $crops = $query->get();

            // Filtrar manualmente los cultivos con mortalidad > 0
            $filteredCrops = $crops->filter(function ($crop) {
                $mortality = $crop->trackings->flatMap->trackingPlants->sum('mortality');
                \Log::debug('Mortality for crop ' . $crop->id . ': ' . $mortality);
                return $mortality > 0;
            })->values();

            // Depuración
            \Log::info('Cultivos encontrados para systemId ' . $systemId . ':', $filteredCrops->toArray());
            if ($filteredCrops->isEmpty()) {
                \Log::warning('No se encontraron cultivos con mortalidad > 0 para systemId ' . $systemId);
            }

            $formattedCrops = $filteredCrops->map(function ($crop) {
                return [
                    'id' => $crop->id,
                    'date' => $crop->date,
                    'quantity' => $crop->quantity,
                    'status' => $crop->status,
                    'species' => [
                        'id' => $crop->species->id ?? null,
                        'name' => $crop->species->name ?? 'Planta sin nombre',
                        'category' => $crop->species->category->name ?? 'Sin categoría'
                    ],
                    'mortality' => $crop->trackings->flatMap->trackingPlants->sum('mortality')
                ];
            });

            return response()->json($formattedCrops);
        } catch (\Exception $e) {
            \Log::error('Error en getCropsBySystem: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getCropDetails($cropId)
    {
        try {
            $crop = Crop::with('species')->findOrFail($cropId);
            $mortality = DB::table('trackings')
                ->join('trackingplant', 'trackings.id', '=', 'trackingplant.tracking_id')
                ->where('trackings.crop_id', $cropId)
                ->sum('trackingplant.mortality');

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
                    ) - (
                        SELECT COALESCE(SUM(rl.quantity), 0)
                        FROM resowing_lot rl
                        WHERE rl.lot_id = lots.id
                    )) as available_capacity')
                )
                ->where('crop_lot.crop_id', $cropId)
                ->get();

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

    public function getCropLotsForEdit($cropId, $resowingId = null)
    {
        try {
            $mortality = DB::table('trackings')
                ->join('trackingplant', 'trackings.id', '=', 'trackingplant.tracking_id')
                ->where('trackings.crop_id', $cropId)
                ->sum('trackingplant.mortality');

            if ($resowingId) {
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
                        ) - (
                            SELECT COALESCE(SUM(rl.quantity), 0)
                            FROM resowing_lot rl
                            WHERE rl.lot_id = lots.id
                            AND rl.resowing_id != ' . $resowingId . '
                        )) as available_capacity')
                    )
                    ->where('crop_lot.crop_id', $cropId)
                    ->get();

                $resowingLots = DB::table('resowing_lot')
                    ->where('resowing_id', $resowingId)
                    ->pluck('quantity', 'lot_id')
                    ->toArray();

                $lots = $allLots->map(function ($lot) use ($resowingLots) {
                    $lot->current_quantity = $resowingLots[$lot->id] ?? 0;
                    return $lot;
                });
            } else {
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
                        ) - (
                            SELECT COALESCE(SUM(rl.quantity), 0)
                            FROM resowing_lot rl
                            WHERE rl.lot_id = lots.id
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

    public function getEditData($id)
    {
        try {
            $resowing = Resowing::with(['lots', 'crops.species', 'system'])->findOrFail($id);
            $cropsInSystem = Crop::where('aquaponic_system_id', $resowing->aquaponic_system_id)
                ->where('status', 'Seguimiento')
                ->whereHas('species.category', function ($query) {
                    $query->where('name', 'Planta');
                })
                ->whereHas('trackings.trackingPlants', function ($query) {
                    $query->where('mortality', '>', 0);
                })
                ->with(['species.category'])
                ->get();

            $mortality = DB::table('trackings')
                ->join('trackingplant', 'trackings.id', '=', 'trackingplant.tracking_id')
                ->where('trackings.crop_id', $resowing->crop_id)
                ->sum('trackingplant.mortality');

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
                    ) - (
                        SELECT COALESCE(SUM(rl.quantity), 0)
                        FROM resowing_lot rl
                        WHERE rl.lot_id = lots.id
                        AND rl.resowing_id != ' . $id . '
                    )) as available_capacity')
                )
                ->where('crop_lot.crop_id', $resowing->crop_id)
                ->get();

            $resowingLots = DB::table('resowing_lot')
                ->where('resowing_id', $resowing->id)
                ->pluck('quantity', 'lot_id')
                ->toArray();

            $lots = $allLots->map(function ($lot) use ($resowingLots) {
                $lot->current_quantity = $resowingLots[$lot->id] ?? 0;
                return $lot;
            });

            return response()->json([
                'resowing' => $resowing,
                'cropsInSystem' => $cropsInSystem,
                'mortality' => $mortality ?? 0,
                'resowingLots' => $lots
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
            ->whereHas('species.category', function ($query) {
                $query->where('name', 'Planta');
            })
            ->whereHas('trackings.trackingPlants', function ($query) {
                $query->where('mortality', '>', 0);
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
            'crops_plantas_seguimiento_with_mortality' => $plantaCrops->count(),
            'aquaponic_systems' => $aquaponicSystems->count(),
            'debug_crop_30' => [
                'exists' => $problemCrop ? true : false,
                'species_id' => $cropSpeciesId,
                'species_exists' => $speciesExists ? true : false,
                'species_name' => $speciesExists ? $speciesExists->name : 'No existe',
                'category_name' => $speciesExists && $speciesExists->category ? $speciesExists->category->name : 'Sin categoría',
                'raw_data' => $problemCrop ? $problemCrop->toArray() : null
            ],
            'plantas_crops' => $plantaCrops->map(function ($crop) {
                $mortality = DB::table('trackings')
                    ->join('trackingplant', 'trackings.id', '=', 'trackingplant.tracking_id')
                    ->where('trackings.crop_id', $crop->id)
                    ->sum('trackingplant.mortality');
                return [
                    'id' => $crop->id,
                    'species_id' => $crop->species_id,
                    'species_name' => $crop->species ? $crop->species->name : 'Relación rota',
                    'category_name' => $crop->species && $crop->species->category ? $crop->species->category->name : 'Sin categoría',
                    'status' => $crop->status,
                    'aquaponic_system_id' => $crop->aquaponic_system_id,
                    'aquaponic_system_name' => $crop->aquaponicSystem ? $crop->aquaponicSystem->name : 'Sin sistema',
                    'total_mortality' => $mortality
                ];
            })
        ]);
    }
}
