<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\Category;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\ACUAPONICO\Entities\speciesAquaponic;
use Modules\ACUAPONICO\Entities\CropAquaponic;


class ProductionController extends Controller
{

    public function index()
    {
        $species = speciesAquaponic::all();
        $lotes = Lot::all();
        //paginacion de cultivos
        $cultivos = CropAquaponic::select('id','date','species_id','lot_id','quantity')
                ->with([
                    'species:id,common_name', 
                    'lot:id,name'])
                ->paginate(10, ['*'], 'page_cultivos');

        //paginacion de categorias
        $categorias = Category::select('id', 'name', 'date')
                ->paginate(10, ['*'], 'page_categorias');

        return view('acuaponico::admin.produccion', compact('species', 'lotes', 'cultivos', 'categorias'));
    }


    public function create()
    {
        return view('acuaponico::create');
    }


    public function store(Request $request)
    {
        //
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
        //
    }

    public function destroy($id)
    {
        //
    }
}
