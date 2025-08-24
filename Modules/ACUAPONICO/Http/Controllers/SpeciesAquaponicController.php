<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Specie;
use Modules\ACUAPONICO\Entities\Category;
use Illuminate\Database\QueryException;

class SpeciesAquaponicController extends Controller
{

    public function index()
    {
        $especies = Specie::with('category')
            ->whereNotNull('category_id')
            ->get();
        $categorias = Category::all();
        return view('acuaponico::pasante.especies', compact('especies', 'categorias'));
    }

    public function registroEspecies()
    {
        $especies = Specie::with('category')
            ->whereNotNull('category_id')
            ->get();
        $categorias = Category::all();
        return view('acuaponico::admin.registroespecie', compact('especies', 'categorias'));
    }

    public function store(Request $request)
    {
        $category_id = $request->category_id;
        $scientific_name = $request->scientific_name;
        $name = $request->name;
        $description = $request->description;
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('modules/acuaponico/images/especies'), $imageName);
            $imagePath = $imageName;
        }


        $species = new Specie();
        $species->category_id = $category_id;
        $species->scientific_name = $scientific_name;
        $species->name = $name;
        $species->image = $imagePath;
        $species->description = $description;
        $species->save();

        return redirect()->back()->with('success', 'Especie generada correctamente.');
    }



    public function update(Request $request, $id)
    {
        $especies = Specie::findOrFail($id);
        $especies->category_id = $request->input('category_id');
        $especies->name = $request->input('scientific_name');
        $especies->name = $request->input('name');
         if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($especies->image && file_exists(public_path('modules/acuaponico/images/especies/' . $especies->image))) {
                unlink(public_path('modules/acuaponico/images/especies/' . $especies->image));
            }

            // Guardar nueva imagen
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('modules/acuaponico/images/especies'), $filename);

            // Asignar nuevo nombre al modelo
            $especies->image = $filename;
        };
        $especies->description = $request->input('description');
        $especies->save();

        return redirect()->back()->with('success', 'especie generada correctamente.');
        return view('acuaponico::pasante.especies');
    }


    public function destroy($id)
    {
        try {
            $especies = Specie::findOrFail($id);
            $especies->delete();

            return redirect()->back()->with('success', 'Especie eliminada correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->back()->with('error', 'No se puede eliminar esta especie porque está relacionada con otro registro.');
            }

            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar la especie.');
        }
    }
}
