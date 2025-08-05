<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\SpeciesAquaponic;
use Modules\ACUAPONICO\Entities\Category;
use Illuminate\Database\QueryException;

class SpeciesAquaponicController extends Controller
{

    public function index()
    {
        $especies = SpeciesAquaponic::with('category')->get();
        $categorias = Category::all();
        return view('acuaponico::pasante.especies', compact('especies', 'categorias'));
    }

    public function registroEspecies()
    {
        $especies = SpeciesAquaponic::with('category')->get();
        $categorias = Category::all();
        return view('acuaponico::admin.registroespecie', compact('especies', 'categorias'));
    }




    public function store(Request $request)
    {
        $date = $request->date;
        $category_id = $request->category_id;
        $scientific_name = $request->scientific_name;
        $common_name = $request->common_name;
        $life_cycle = $request->life_cycle;
        $optimal_temperature = $request->optimal_temperature;


        $species = new SpeciesAquaponic();
        $species->date = $date;
        $species->category_id = $category_id;
        $species->scientific_name = $scientific_name;
        $species->common_name = $common_name;
        $species->life_cycle = $life_cycle;
        $species->optimal_temperature = $optimal_temperature;
        $species->save();

        return redirect()->back()->with('success', 'Especie generada correctamente.');
        return view('acuaponico::pasante.especies');
    }


    public function update(Request $request, $id)
    {
        $especies = SpeciesAquaponic::findOrFail($id);
        $especies->date = $request->input('date');
        $especies->category_id = $request->input('category_id');
        $especies->scientific_name = $request->input('scientific_name');
        $especies->common_name = $request->input('common_name');
        $especies->life_cycle = $request->input('life_cycle');
        $especies->optimal_temperature = $request->input('optimal_temperature');
        $especies->save();

        return redirect()->back()->with('success', 'especie generada correctamente.');
        return view('acuaponico::pasante.especies');
    }


    public function destroy($id)
    {
        try {
            $especies = SpeciesAquaponic::findOrFail($id);
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
