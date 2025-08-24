<?php
namespace Modules\ACUAPONICO\Http\Controllers;


namespace Modules\ACUAPONICO\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ACUAPONICO\Entities\AquaponicSystem;
use Modules\ACUAPONICO\Entities\Lot;
use Modules\AGROCEFA\Entities\Crop;
use Modules\ACUAPONICO\Entities\HarvestAquaponic;
use Illuminate\Support\Facades\DB;

class ACUAPONICOController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('acuaponico::index');
    }
    public function welcome()
    {
        return view('acuaponico::welcome');
    }
    public function admin()
    {
        return view('acuaponico::welcome');
    }
    public function pasante()
    {
        $systems = AquaponicSystem::get(); // Obtiene todos los sistemas acuapónicos
        $lotsCount = Lot::count(); // Obtiene el número total de lotes
        $cropsCount = Crop::where('status', 'Seguimiento')->count(); // Obtiene el número de cultivos en seguimiento
        $mortalityData = HarvestAquaponic::select('aquaponic_system_id', 'harvestable_id', 'harvestable_type', DB::raw('SUM(mortality) as total_mortality'))
            ->groupBy('aquaponic_system_id', 'harvestable_id', 'harvestable_type')
            ->get(); // Obtiene datos de mortalidad agregados
        $cropsBySystem = Crop::select('aquaponic_system_id', DB::raw('COUNT(id) as count'))
            ->groupBy('aquaponic_system_id')
            ->get(); // Obtiene la distribución de cultivos por sistema
        return view('acuaponico::welcomepas', compact('systems', 'lotsCount', 'cropsCount', 'mortalityData', 'cropsBySystem'));
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
        //
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
        //
    }



    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        return;
    }
}
