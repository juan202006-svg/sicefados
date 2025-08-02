<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\SICA\Entities\Environment;

class AquaponicSystemController extends Controller
{
    public function index()
    {
        $environment = Environment::all();

        $acuaponico = AquaponicSystem::with('environment')->get();

        return view('acuaponico::pasante.acuaponico', compact('acuaponico', 'environment'));
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
        $acuaponico->environment_id = $request->environment_id;
        $acuaponico->save();

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
        $acuaponico->environment_id = $request->environment_id;
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
