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
use Modules\ACUAPONICO\Entities\Resowing;
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
        $systems = AquaponicSystem::get(); // Todos los sistemas acuapónicos
        $availableLotsCount = Lot::where('state', 'disponible')->count(); // Lotes disponibles
        $cropsCount = Crop::where('status', 'Seguimiento')->count(); // Cultivos activos (en seguimiento)
        $resowingsCount = Resowing::whereIn('status', ['Registrada', 'Seguimiento'])->count(); // Resiembras activas

        $mortalityData = HarvestAquaponic::select('aquaponic_system_id', 'harvestable_id', 'harvestable_type', DB::raw('SUM(mortality) as total_mortality'))
            ->groupBy('aquaponic_system_id', 'harvestable_id', 'harvestable_type')
            ->get(); // Datos de mortalidad

        $cropsBySystem = Crop::select('aquaponic_system_id', DB::raw('COUNT(id) as count'))
            ->groupBy('aquaponic_system_id')
            ->get(); // Distribución de cultivos por sistema

        // Nuevos datos para gráfica de cultivos por especie (usando species_id de crops)
        $cropsBySpecies = Crop::select('species_id', DB::raw('COUNT(id) as count'))
            ->where('status', 'Seguimiento') // Solo activos
            ->groupBy('species_id')
            ->with('species') // Asumiendo relación con Species para obtener nombres
            ->get();

        // Opcional: Datos para gráfica de resiembras por estado
        $resowingsByStatus = Resowing::select('status', DB::raw('COUNT(id) as count'))
            ->groupBy('status')
            ->get();

        return view('acuaponico::welcomepas', compact(
            'systems',
            'availableLotsCount',
            'cropsCount',
            'resowingsCount',
            'mortalityData',
            'cropsBySystem',
            'cropsBySpecies',
            'resowingsByStatus'
        ));
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
