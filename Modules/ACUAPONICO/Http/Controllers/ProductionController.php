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

        if (request()->ajax()) {
            return view('acuaponico::admin.producciones', compact('species',));
        }

        return view('acuaponico::admin.produccion', compact('species'));
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
