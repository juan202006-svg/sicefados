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
        $cultivos = CropAquaponic::with('species')->get();
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
            $cosecha->delete();

            return redirect()->back()->with('success', 'Cosecha  eliminada correctamente.');
    }
}
