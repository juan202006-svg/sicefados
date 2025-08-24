<?php

namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\ACUAPONICO\Entities\Category;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\AGROCEFA\Entities\specie;
use Modules\ACUAPONICO\Entities\CropAquaponic;


class ProductionController extends Controller
{

    public function index()
    {
        $species = specie::all();

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
