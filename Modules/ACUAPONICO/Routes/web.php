<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['lang'])->group(function () {
    Route::prefix('acuaponico')->group(function () {
        Route::get('/index', 'ACUAPONICOController@index')->name('cefa.acuaponico.index');
        Route::get('/admin/welcome', 'ACUAPONICOController@admin')->name('acuaponico.admin.welcome');
        Route::get('/pasante/welcomepas', 'ACUAPONICOController@pasante')->name('acuaponico.pasante.welcomepas');
    });
});
Route::controller(LotController::class)->group(function () {
    Route::get('/pasante/pasante/index', 'index')->name('acuaponico.pasante.pasante.index');
    Route::get('/pasante/pasante/create', 'cerate')->name('acuaponico.pasante.pasante.cerateLot');
    Route::post('/pasante/pasante/store', 'store')->name('acuaponico.pasante.pasante.storeLot');
    Route::put('/pasante/lote/update/{id}', 'update')->name('acuaponico.pasante.pasante.updateLot');
    Route::delete('/pasante/lote/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroyLot');
});
// rutas de las categorias

Route::controller(CategoryController::class)->group(function () {
    Route::get('/pasante/pasante/categoria', 'index')->name('acuaponico.pasante.pasante.categoria');
    Route::post('/pasante/pasante/categoria/store', 'store')->name('acuaponico.pasante.pasante.storeCategory');
    Route::get('/pasante/categoria/create', 'create')->name('acuaponico.pasante.pasante.createCategory');
    Route::put('/pasante/categoria/update/{id}', 'update')->name('acuaponico.pasante.pasante.updateCategory');
    Route::delete('/pasante/categoria/destoy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroyCategory');
});

// rutas  para las especies
Route::controller(SpeciesAquaponicController::class)->group(function () {
    Route::get('/pasante/lista/especies', 'index')->name('acuaponico.pasante.pasante.indexspecies');
    Route::get('/pasante/crear/create', 'create')->name('acuaponico.pasante.pasante.creatspecies');
    Route::post('/pasante/espcies/store', 'store')->name('acuaponico.pasante.pasante.storespecies');
    Route::put('/pasante/especie/update/{id}', 'update')->name('acuaponico.pasante.pasante.updatespecies');
    Route::delete('/pasante/especie/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroyspecies');
});

// rutas para los cultivos}
Route::controller(CropAquaponicController::class)->group(function () {
    Route::get('/pasante/cultivo/lista', 'index')->name('acuaponico.pasante.pasante.crops');
    Route::get('/pasante/cultivo/create', 'create')->name('acuaponico.pasante.pasante.createcrops');
    Route::post('/pasante/cultivo/store', 'store')->name('acuaponico.pasante.pasante.storecrops');
    Route::put('/pasante/cultivo/update/{id}', 'update')->name('acuaponico.pasante.pasante.updatecrops');
    Route::delete('/pasante/cultivo/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroycrops');
});

// rutas para los seguimientos
Route::controller(TrackingController::class)->group(function () {
    Route::get('/pasante/seguimiento/lista', 'index')->name('acuaponico.pasante.pasante.indextracking');
    Route::get('/pasante/seguimiento/create', 'create')->name('acuaponico.pasante.pasante.createtracking');
    Route::post('/pasante/seguimiento/store', 'store')->name('acuaponico.pasante.pasante.storetracking');
    Route::put('/pasante/seguimiento/update/{id}', 'update')->name('acuaponico.pasante.pasante.updatetracking');
    Route::delete('/pasante/seguimiento/destroy/{id}', 'destroy')->name('acuaponico.pasante.pasante.destroytracking');
});