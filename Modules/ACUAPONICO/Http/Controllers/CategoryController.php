<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()

    {  
        $categorias = Category::get();
        return view('acuaponico::pasante.categoria', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('acuaponico::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
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

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('acuaponico::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('acuaponico::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        
        $category = Category::findOrFail($id);
        $category->date = $request->input('date');
        $category->name = $request->input('name');
        $category->save();
    
        return redirect()->back()->with('success', 'Categoria generada correctamente.');
        return view('acuaponico::pasante.categoria');
        
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('acuaponico.pasante.pasante.categoria')->with('success', 'Categoría eliminada correctamente');

        return view('acuaponico::pasante.categoria');
    }
}