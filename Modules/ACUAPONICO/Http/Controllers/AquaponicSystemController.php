<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\SICA\Entities\Environment;

class AquaponicSystemController extends Controller
{
    public function index()
    {

        $acuaponico = AquaponicSystem::get();

        return view('acuaponico::pasante.acuaponico', ['acuaponico' => $acuaponico,]);
    }

    public function registerAcuaponic()
    {
        $acuaponico = AquaponicSystem::get();

        return view('acuaponico::admin.registroacuaponicos', ['acuaponico' => $acuaponico,]);
    }



    public function store(Request $request)
    {
        $acuaponico = new AquaponicSystem();
        $acuaponico->name = $request->name;
        $acuaponico->description = $request->description;
        $acuaponico->location = $request->location;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('modules/acuaponico/images/acuaponico'), $imageName);

            $acuaponico->image = $imageName;
        }


        $acuaponico->lot_capacity = $request->lot_capacity;
        $acuaponico->active = $request->active;
        $acuaponico->save();

        $lot = new Environment();
        $lot->name = $request->name . ' - Lote';
        $lot->description = $request->description;
        $lot->location = $request->location;
        $lot->image = $acuaponico->image; 

        return redirect()->back()->with('success', 'Sistema acuapónico creado correctamente.');
    }


    public function update(Request $request, $id)
    {
        $acuaponico = AquaponicSystem::findOrFail($id);
        $acuaponico->name = $request->name;
        $acuaponico->description = $request->description;
        $acuaponico->location = $request->location;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('modules/acuaponico/images/acuaponico'), $imageName);

            $acuaponico->image = $imageName;
        }


        $acuaponico->lot_capacity = $request->lot_capacity;
        $acuaponico->active = $request->active;
        $acuaponico->save();

        return redirect()->back()->with('success', 'Sistema acuapónico actualizado correctamente.');
    }

    public function destroy($id)
    {
        
        $acuaponico = AquaponicSystem::findOrFail($id);
        $acuaponico->delete();

        return redirect()->back()->with('success', 'Sistema acuapónico eliminado correctamente.');
    }
}
