<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\ACUAPONICO\Entities\Category;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function index()
    {  
        $categorias = Category::get();

        return view('acuaponico::pasante.categoria', ['categorias' => $categorias]);
    }

    public function registroCategoria()
    {
        $categorias = Category::get();
        return view('acuaponico::admin.registrocategoria', ['categorias' => $categorias]);
    }
    

    
    public function create()
    {
        return view('acuaponico::create');
    }


    public function store(Request $request)
    {
        $date = $request->date;
        $name = $request->name;
        $category = new Category();
        $category->date = $date;
        $category->name = $name;
        $category->save();


        return redirect()-> back()->with('success', 'Categoria generada correctamente.');

        return view('acuaponico::pasante.categoria');
    }


    public function show($id)
    {
        return view('acuaponico::show');
    }


    public function edit($id)
    {
        return view('acuaponico::edit');
    }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->save();
    
        return redirect()->back()->with('success', 'Categoria generada correctamente.');
        return view('acuaponico::pasante.categoria');
        
    }

    public function destroy($id)
    {
       try {
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->back()->with('success', 'Categoria eliminado correctamente.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') { 
                return redirect()->back()->with('error', 'No se puede eliminar esta categoria porque está relacionada con otro registro.');
            }

            return redirect()->back()->with('error', 'Ocurrió un error al intentar eliminar la categoria.');
        }
    }
}