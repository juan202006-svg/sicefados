<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\CropAquaponic;
use Modules\ACUAPONICO\Entities\HarvestAquaponic;

class HarvestAquaponicController extends Controller
{

    public function index()
    {
        // Cultivos en seguimiento
        $cultivosSeguimiento = CropAquaponic::with('species')->where('status', 'Seguimiento')->get();

        // Cultivos usados en cosechas aunque ya no estén en seguimiento
        $cultivosUsados = HarvestAquaponic::with('crops.species')->get()
            ->pluck('crops')
            ->unique('id');

        // Combinar ambos y eliminar duplicados
        $cultivos = $cultivosSeguimiento->concat($cultivosUsados)->unique('id');

        $cosechas = HarvestAquaponic::with('crops.species')->get();
        return view('acuaponico::pasante.cosechas', compact('cultivos', 'cosechas'));
    }

    public function store(Request $request)
    {
        $cosecha = new HarvestAquaponic();
        $cosecha->date = $request->date;
        $cosecha->crop_id = $request->crop_id;
        $cosecha->quantity = $request->quantity;
        $cosecha->unit = $request->unit;
        $cosecha->destination = $request->destination;
        $cosecha->mortality = $request->mortality;
        $cosecha->notes = $request->notes;
        $cosecha->save();

        $cultivo = CropAquaponic::findOrFail($request->crop_id);
        // Cambiar el estado del cultivo a 'en seguimiento'
        $cultivo->status = 'Cosechado';
        $cultivo->save();

        return redirect()->back()->with('success', 'Cosecha registrada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $cosecha = HarvestAquaponic::findOrFail($id);
        $cosecha->date = $request->input('date');
        $cosecha->crop_id = $request->input('crop_id');
        $cosecha->quantity = $request->input('quantity');
        $cosecha->unit = $request->input('unit');
        $cosecha->destination = $request->input('destination');
        $cosecha->mortality = $request->input('mortality');
        $cosecha->notes = $request->input('notes');
        $cosecha->save();

        return redirect()->back()->with('success', 'Cosecha actualizada correctamente.');
    }

    public function destroy($id)
    {
        $cosecha = HarvestAquaponic::findOrFail($id);

        // Obtener el cultivo asociado a la cosecha
        $cultivo = CropAquaponic::find($cosecha->crop_id);

        // Eliminar la cosecha
        $cosecha->delete();

        // Si existe el cultivo, actualizar su estado a "Seguimiento"
        if ($cultivo) {
            $cultivo->status = 'Seguimiento';
            $cultivo->save();
        }

        return redirect()->back()->with('success', 'Cosecha eliminada correctamente y estado del cultivo actualizado.');
    }
}
