<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\Resowing;
use Modules\ACUAPONICO\Entities\HarvestAquaponic;
use Modules\ACUAPONICO\Entities\AquaponicSystem;    

class HarvestAquaponicController extends Controller
{
    public function index()
    {
        $systems = AquaponicSystem::get();
        $cosechas = HarvestAquaponic::with(['aquaponicSystem', 'harvestable'])->get();

        return view('acuaponico::pasante.cosechas', ['systems' => $systems, 'cosechas' => $cosechas]);
    }

    public function registroCosechas()
    {
        $systems = AquaponicSystem::get();
        $cosechas = HarvestAquaponic::with(['aquaponicSystem', 'harvestable'])->get();

        return view('acuaponico::admin.registrocosecha', ['systems' => $systems, 'cosechas' => $cosechas]);
    }

    public function getHarvestablesBySystem($systemId)
    {
        // Obtener cultivos y resiembras en estado "Seguimiento"
        $crops = Crop::with('species')
            ->where('aquaponic_system_id', $systemId)
            ->where('status', 'Seguimiento')
            ->get()
            ->map(function ($crop) {
                return [
                    'id' => $crop->id,
                    'type' => 'Modules\AGROCEFA\Entities\Crop',
                    'name' => $crop->species->name . ' (Cultivo)',
                    'quantity' => $crop->quantity,
                    'status' => $crop->status,
                ];
            });

        $resowings = Resowing::where('aquaponic_system_id', $systemId)
            ->where('status', 'Seguimiento')
            ->get()
            ->map(function ($resowing) {
                return [
                    'id' => $resowing->id,
                    'type' => 'Modules\ACUAPONICO\Entities\Resowing',
                    'name' => $resowing->crops->species->name . ' (Resiembra)',
                    'quantity' => $resowing->total_quantity,
                    'status' => $resowing->status,
                ];
            });

        $harvestables = $crops->concat($resowings);

        // Si se pasa un harvestable_id como parámetro (para edición), incluirlo aunque esté cosechado
        $requestHarvestableId = request()->input('harvestable_id');
        $requestHarvestableType = request()->input('harvestable_type');
        if ($requestHarvestableId && $requestHarvestableType) {
            if ($requestHarvestableType === 'Modules\AGROCEFA\Entities\Crop') {
                $harvestable = Crop::with('species')->find($requestHarvestableId);
                if ($harvestable && $harvestable->aquaponic_system_id == $systemId) {
                    $harvestables->push([
                        'id' => $harvestable->id,
                        'type' => $requestHarvestableType,
                        'name' => $harvestable->species->name . ' (Cultivo)',
                        'quantity' => $harvestable->quantity,
                        'status' => $harvestable->status,
                    ]);
                }
            } elseif ($requestHarvestableType === 'Modules\ACUAPONICO\Entities\Resowing') {
                $harvestable = Resowing::find($requestHarvestableId);
                if ($harvestable && $harvestable->aquaponic_system_id == $systemId) {
                    $harvestables->push([
                        'id' => $harvestable->id,
                        'type' => $requestHarvestableType,
                        'name' => $harvestable->crops->species->name . ' (Resiembra)',
                        'quantity' => $harvestable->total_quantity,
                        'status' => $harvestable->status,
                    ]);
                }
            }
        }

        return response()->json($harvestables->unique(function ($item) {
            return $item['id'] . '|' . $item['type'];
        }));
    }
    
    public function store(Request $request)
    {
        $cosecha = new HarvestAquaponic();
        $cosecha->aquaponic_system_id = $request->aquaponic_system_id;
        $cosecha->harvestable_id = $request->harvestable_id;
        $cosecha->harvestable_type = $request->harvestable_type;
        $cosecha->date = $request->date;
        $cosecha->quantity = $request->quantity;
        $cosecha->unit = $request->unit;
        $cosecha->destination = $request->destination;
        $cosecha->mortality = $request->mortality;
        $cosecha->notes = $request->notes;
        $cosecha->save();

        if ($request->harvestable_type === 'Modules\AGROCEFA\Entities\Crop') {
            $cultivo = Crop::findOrFail($request->harvestable_id);
            $cultivo->status = 'Cosechado';
            $cultivo->save();
            // Actualizar los lotes asociados
            foreach ($cultivo->lotes as $lote) {
                $lote->actualizarEstadoAutomatico();
            }
        } elseif ($request->harvestable_type === 'Modules\ACUAPONICO\Entities\Resowing') {
            $resowing = Resowing::findOrFail($request->harvestable_id);
            $resowing->status = 'Cosechada';
            $resowing->save();
            // Actualizar los lotes asociados
            foreach ($resowing->lots as $lote) {
                $lote->actualizarEstadoAutomatico(true);
            }
        }

        return redirect()->back()->with('success', 'Cosecha registrada correctamente. Los lotes han sido actualizados.');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos
        $validated = $request->validate([
            'aquaponic_system_id' => 'required|exists:aquaponic_systems,id',
            'harvestable_id' => 'required|integer',
            'harvestable_type' => 'required|in:Modules\AGROCEFA\Entities\Crop,Modules\ACUAPONICO\Entities\Resowing',
            'date' => 'required|date',
            'quantity' => 'required|numeric|min:1',
            'unit' => 'required|string',
            'destination' => 'nullable|string',
            'mortality' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // Encontrar la cosecha
        $cosecha = HarvestAquaponic::findOrFail($id);
        $oldHarvestable = $cosecha->harvestable;
        $oldLotes = $oldHarvestable ? ($oldHarvestable instanceof Crop ? $oldHarvestable->lotes : $oldHarvestable->lots) : collect();

        // Validar la cantidad disponible para el nuevo harvestable
        $totalAvailable = 0;
        if ($validated['harvestable_type'] === 'Modules\AGROCEFA\Entities\Crop') {
            $cultivo = Crop::with('lotes')->findOrFail($validated['harvestable_id']);
            $totalAvailable = $cultivo->lotes()->wherePivot('planted_quantity', '>', 0)->sum('crop_lot.planted_quantity');
        } elseif ($validated['harvestable_type'] === 'Modules\ACUAPONICO\Entities\Resowing') {
            $resowing = Resowing::with('lots')->findOrFail($validated['harvestable_id']);
            $totalAvailable = $resowing->lots()->wherePivot('quantity', '>', 0)->sum('resowing_lot.quantity');
        }

        if ($validated['quantity'] > $totalAvailable) {
            return redirect()->back()->withErrors(['La cantidad cosechada (' . $validated['quantity'] . ') excede las unidades disponibles (' . $totalAvailable . ').']);
        }

        // Actualizar la cosecha
        $cosecha->aquaponic_system_id = $validated['aquaponic_system_id'];
        $cosecha->harvestable_id = $validated['harvestable_id'];
        $cosecha->harvestable_type = $validated['harvestable_type'];
        $cosecha->date = $validated['date'];
        $cosecha->quantity = $validated['quantity'];
        $cosecha->unit = $validated['unit'];
        $cosecha->destination = $validated['destination'];
        $cosecha->mortality = $validated['mortality'];
        $cosecha->notes = $validated['notes'];
        $cosecha->save();

        // Marcar el nuevo harvestable como cosechado y actualizar lotes
        $newLotes = collect();
        if ($validated['harvestable_type'] === 'Modules\AGROCEFA\Entities\Crop') {
            $cultivo->status = 'Cosechado';
            $cultivo->save();
            $newLotes = $cultivo->lotes;
        } elseif ($validated['harvestable_type'] === 'Modules\ACUAPONICO\Entities\Resowing') {
            $resowing->status = 'Cosechada';
            $resowing->save();
            $newLotes = $resowing->lots;
        }

        // Si el harvestable cambió, restaurar el estado del anterior
        if ($oldHarvestable && ($oldHarvestable->id != $validated['harvestable_id'] || $oldHarvestable::class != $validated['harvestable_type'])) {
            $oldHarvestable->status = 'Seguimiento';
            $oldHarvestable->save();
        }

        // Actualizar todos los lotes afectados
        $lotesToUpdate = $oldLotes->merge($newLotes)->unique('id');
        foreach ($lotesToUpdate as $lote) {
            $lote->actualizarEstadoAutomatico(true);
        }

        return redirect()->back()->with('success', 'Cosecha actualizada correctamente. Los lotes han sido actualizados.');
    }
    public function destroy($id)
    {
        $cosecha = HarvestAquaponic::findOrFail($id);
        $harvestable = $cosecha->harvestable;

        // Obtener los lotes asociados
        $lotes = $harvestable ? ($harvestable instanceof Crop ? $harvestable->lotes : $harvestable->lots) : collect();

        // Eliminar la cosecha
        $cosecha->delete();

        // Restaurar el estado del harvestable
        if ($harvestable instanceof Crop) {
            $harvestable->status = 'Seguimiento';
            $harvestable->save();
        } elseif ($harvestable instanceof Resowing) {
            $harvestable->status = 'Seguimiento';
            $harvestable->save();
        }

        // Actualizar los lotes asociados
        foreach ($lotes as $lote) {
            $lote->actualizarEstadoAutomatico(true);
        }

        return redirect()->back()->with('success', 'Cosecha eliminada correctamente y estado de lotes actualizado.');
    }
}
