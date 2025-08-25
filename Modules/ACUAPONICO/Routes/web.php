<?php

use NumberToWords\Legacy\Numbers\Words\Locale\Ro;

Route::middleware(['lang'])->group(function () {
    Route::prefix('acuaponico')->group(function () {
        Route::get('/index', 'ACUAPONICOController@index')->name('cefa.acuaponico.index');
        Route::get('/admin/welcome', 'ACUAPONICOController@admin')->name('acuaponico.admin.welcome');
        Route::get('/pasante/welcomepas', 'ACUAPONICOController@pasante')->name('acuaponico.pasante.welcomepas');
    });
});

Route::controller(UserAquaponicController::class)->group(function () {
    Route::get('/admin/usuarios', 'index')->name('acuaponico.admin.admin.usuarios');
    Route::post('/admin/usuarios/store', 'store')->name('acuaponico.admin.admin.storeUsuarios');
    Route::put('/admin/usuarios/update/{id}', 'update')->name('acuaponico.admin.admin.updateUsuarios');
    Route::get('/admin/usuarios/edit/{id}', 'edit')->name('acuaponico.admin.admin.editUsuarios');
    Route::delete('/admin/usuarios/destroy/{id}', 'destroy')->name('acuaponico.admin.admin.destroyUsuarios');
});


//vista de produccion admin
Route::controller(ProductionController::class)->group(function () {
    Route::get('/admin/produccion', 'index')->name('acuaponico.admin.admin.produccion');
});

// vista de actividades
Route::controller(ActivityController::class)->group(function () {
    Route::get('/admin/actividades', 'index')->name('acuaponico.admin.admin.actividades');
    Route::get('/admin/actividades/enviadas', 'enviados')->name('acuaponico.pasante.pasante.indexactivity');
    Route::post('/admin/actividades/store', 'store')->name('acuaponico.admin.admin.store');
    Route::put('/admin/actividades/update/{id}', 'update')->name('acuaponico.admin.admin.update');
    Route::delete('/admin/actividades/destroy/{id}', 'destroy')->name('acuaponico.admin.admin.destroy');
    Route::put('/admin/actividades/send/{id}', 'enviar')->name('acuaponico.admin.admin.send');
    Route::get('/evidencia/{id}/descargar', 'descargarEvidencia')->name('evidencia.descargar');
    Route::get('/evidencia/{id}/ver', 'verEvidencia')->name('evidencia.ver');
});
// rutas de los sistemas acuaponicos
Route::controller(AquaponicSystemController::class)->group(function () {
    Route::get('/pasante/sistemas_acuaponicos/lista', 'index')->name('acuaponico.pasante.pasante.acuaponicoindex');
    Route::post('/pasante/sistemas_acuaponicos/store', 'store')->name('acuaponico.pasante.pasante.acuaponicostore');
    Route::put('/pasante/sistemas_acuaponicos/update/{id}', 'update')->name('acuaponico.pasante.pasante.acuaponicoupdate');
    Route::delete('/pasante/sistemas_acuaponicos/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.acuaponicodestroy');

    //admin
    Route::get('/admin/admin/registroacuaponico', 'registerAcuaponic')->name('acuaponico.admin.admin.registroacuaponicos');
});


Route::controller(LotController::class)->group(function () {
    Route::get('/pasante/pasante/index', 'index')->name('acuaponico.pasante.pasante.index');
    Route::get('/pasante/pasante/create', 'cerate')->name('acuaponico.pasante.pasante.cerateLot');
    Route::post('/pasante/pasante/store', 'store')->name('acuaponico.pasante.pasante.storeLot');
    Route::put('/pasante/lote/update/{id}', 'update')->name('acuaponico.pasante.pasante.updateLot');
    Route::delete('/pasante/lote/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroyLot');

    // admin

    Route::get('/admin/admin/registrolote', 'showRegistroLote')->name('acuaponico.admin.admin.registrolote');
});
// rutas de las categorias

Route::controller(CategoryController::class)->group(function () {
    Route::get('/pasante/pasante/categoria', 'index')->name('acuaponico.pasante.pasante.categoria');
    Route::post('/pasante/pasante/categoria/store', 'store')->name('acuaponico.pasante.pasante.storeCategory');
    Route::get('/pasante/categoria/create', 'create')->name('acuaponico.pasante.pasante.createCategory');
    Route::put('/pasante/categoria/update/{id}', 'update')->name('acuaponico.pasante.pasante.updateCategory');
    Route::delete('/pasante/categoria/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroyCategory');
    //admin
    Route::get('/admin/admin/registrocategoria', 'registroCategoria')->name('acuaponico.admin.admin.registrocategoria');
});

// rutas  para las especies
Route::controller(SpeciesAquaponicController::class)->group(function () {
    Route::get('/pasante/lista/especies', 'index')->name('acuaponico.pasante.pasante.indexspecies');
    Route::get('/pasante/crear/create', 'create')->name('acuaponico.pasante.pasante.creatspecies');
    Route::post('/pasante/espcies/store', 'store')->name('acuaponico.pasante.pasante.storespecies');
    Route::put('/pasante/especie/update/{id}', 'update')->name('acuaponico.pasante.pasante.updatespecies');
    Route::delete('/pasante/especie/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroyspecies');

    //admin
    Route::get('/admin/admin/registroespecies', 'registroEspecies')->name('acuaponico.admin.admin.registroespecie');
});

// rutas para los cultivos
Route::controller(CropAquaponicController::class)->group(function () {
    Route::get('/pasante/cultivo/lista', 'index')->name('acuaponico.pasante.pasante.crops');
    Route::post('/pasante/cultivo/store', 'store')->name('acuaponico.pasante.pasante.storecrops');
    Route::put('/pasante/cultivo/update/{id}', 'update')->name('acuaponico.pasante.pasante.updatecrops');
    Route::delete('/pasante/cultivo/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroycrops');

    //admin
    Route::get('/admin/admin/registrocultivos', 'registroCultivo')->name('acuaponico.admin.admin.registrocultivo');
    Route::get('/pasante/cultivo/lotes-por-sistema/{id}', 'getLotesPorSistema')->name('acuaponico.pasante.pasante.lotes_por_sistema');
});




// rutas para los seguimientos
Route::controller(TrackingController::class)->group(function () {
    Route::get('/pasante/seguimiento/lista', 'index')->name('acuaponico.pasante.pasante.indextracking');
    Route::get('/pasante/seguimiento/create', 'create')->name('acuaponico.pasante.pasante.createtracking');
    Route::post('/pasante/seguimiento/store', 'store')->name('acuaponico.pasante.pasante.storetracking');
    Route::put('/pasante/seguimiento/update/{id}', 'update')->name('acuaponico.pasante.pasante.updatetracking');
    Route::delete('/pasante/seguimiento/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroytracking');
    Route::get('/pasante/seguimiento/subjects/{systemId}', 'getSubjectsBySystem')->name('acuaponico.pasante.pasante.subjects');
    //admin
    Route::get('/admin/admin/seguimientogeneral', 'General')->name('acuaponico.admin.admin.seguimientogeneral');
});

// rutas para los seguimientos de peces
Route::controller(TrackingFishController::class)->group(function () {
    Route::get('/pasante/seguimientoPez/peces', 'index')->name('acuaponico.pasante.pasante.indextrakingfish');
    Route::post('/pasante/seguimientoPez/store', 'store')->name('acuaponico.pasante.pasante.storetrackingfish');
    Route::put('/pasante/seguimientoPez/update/{id}', 'update')->name('acuaponico.pasante.pasante.updatetrackingfish');
    Route::delete('/pasante/seguimientoPez/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroytrackingfish');
    Route::get('/pasante/seguimientoPez/prevdata/{id}', 'getPreviousFishData')->name('seguimientopez.prevdata');


    //admin
    Route::get('/admin/admin/registropezseguimiento', 'trackingFishs')->name('acuaponico.admin.admin.pezseguimiento');
});


Route::get('/masterusers', function () {
    return view('acuaponico.layouts.masterusers');
})->name('acuaponico.layouts.masterusers');

// rutas para los seguimientos de plantas
Route::controller(TrackingPlantController::class)->group(function () {
    Route::get('/pasante/seguimientoPlanta/plantas', 'index')->name('acuaponico.pasante.pasante.indextrackingplant');
    Route::post('/pasante/seguimientoPlanta/store', 'store')->name('acuaponico.pasante.pasante.storetrackingplant');
    Route::put('/pasante/seguimientoPlanta/update/{id}', 'update')->name('acuaponico.pasante.pasante.updatetrackingplant');
    Route::delete('/pasante/seguimientoPlanta/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroytrackingplant');
    Route::get('/pasante/seguimientoPlanta/prevdata/{tracking_id}', 'obtenerDatosAnteriores')->name('acuaponico.pasante.pasante.prevdatatrackingplant');
    Route::get('/pasante/seguimientoPlanta/seguimientos/{aquaponic_system_id}', 'obtenerSeguimientos')->name('acuaponico.pasante.pasante.seguimientosplant');

    //admin
    Route::get('/admin/admin/registroplantaseguimiento', 'trackingPlants')->name('acuaponico.admin.admin.plantaseguimiento');
});

// rutas para las cosechas
Route::controller(HarvestAquaponicController::class)->group(function () {
    Route::get('/pasante/cosecha/lista', 'index')->name('acuaponico.pasante.pasante.indexharvest');
    Route::post('/pasante/cosecha/store', 'store')->name('acuaponico.pasante.pasante.storeharvest');
    Route::put('/pasante/cosecha/update/{id}', 'update')->name('acuaponico.pasante.pasante.updateharvest');
    Route::delete('/pasante/cosecha/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroyharvest');
    Route::get('/harvests/harvestables-by-system/{systemId}',  'getHarvestablesBySystem')->name('acuaponico.pasante.pasante.harvests.harvestables-by-system');

    //admin
    Route::get('/admin/admin/registrocosechas', 'registroCosechas')->name('acuaponico.admin.admin.registrocosecha');
});

// rutas para el control de actividades
Route::controller(ActivityControlController::class)->group(function () {
    Route::get('/pasante/actividad/lista', 'index')->name('acuaponico.pasante.pasante.indexactivity');
    Route::post('/pasante/controlactividad/store', 'store')->name('acuaponico.pasante.pasante.storecontrolactivity');
    Route::put('/pasante/controlactividad/update/{id}', 'update')->name('acuaponico.pasante.pasante.updatecontrolactivity');
    Route::delete('/pasante/controlactividad/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroycontrolactivity');
    Route::get('/evidencia/{id}/ver', 'verEvidencia')->name('evidencia.ver');
});

// rutas para las resiembras
Route::controller(ResowingController::class)->group(function () {
    Route::get('/pasante/resiembras/lista', 'index')->name('acuaponico.pasante.pasante.indexresowing');
    Route::post('/pasante/resiembras/store', 'store')->name('acuaponico.pasante.pasante.storeresowing');
    Route::put('/pasante/resiembras/update/{id}', 'update')->name('acuaponico.pasante.pasante.updateresowing');
    Route::delete('/pasante/resiembras/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroyresowing');
    Route::get('/crop-details/{cropId}', 'getCropDetails');
    Route::get('/crops-by-system/{systemId}/{resowingId?}', 'getCropsBySystem');
    Route::get('/resowing-edit-data/{id}', 'getEditData')->name('acuaponico.pasante.pasante.getEditData');
    Route::get('/crop-lots-for-edit/{cropId}/{resowingId?}', 'getCropLotsForEdit');
    // Ruta temporal de debug
    Route::get('/debug-crops', 'debugCrops');
    //admin
    Route::get('/admin/admin/registroresiembras', 'registroResiembras')->name('acuaponico.admin.admin.registroresiembras');
});

Route::controller(ResowingTrackingController::class)->group(function () {
    Route::get('/pasante/seguimiento_resiembra', 'index')->name('acuaponico.pasante.pasante.indexresowingtracking');
    Route::post('/pasante/seguimiento_resiembra/store', 'store')->name('acuaponico.pasante.pasante.storeresowingtracking');
    Route::put('/pasante/seguimiento_resiembra/update/{id}', 'update')->name('acuaponico.pasante.pasante.updateresowingtracking');
    Route::delete('/pasante/seguimiento_resiembra/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroyresowingtracking');
   Route::get('/pasante/seguimiento_resiembra/previous/{resowing_id}', 'getPreviousTracking')->name('acuaponico.pasante.pasante.previousresowingtracking');


   //admin
   Route::get('/admin/admin/registroseguimiento', 'resowingTracking')->name('acuaponico.admin.admin.registroseguimiento');
});
