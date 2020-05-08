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
Route::get('/', function () {
    return redirect('/demo');
});
Route::get('/demo',['middleware' => 'throttle:60,5', function () {
    return view('auth.login');
}]);

Route::group(['prefix' => 'reservaciones'], function () {
    Route::get('/','ReservacionesController@index')->middleware(['auth']);
    Route::get('/dashboard','ReservacionesController@dashboard')->middleware(['auth']);
    Route::get('getActividades', 'ReservacionesController@getActividades')->middleware(['auth']);
    Route::get('/gethorarios', 'ReservacionesController@getHorarios')->middleware(['auth']);
    Route::get('/getsalidas-llegadas', 'ReservacionesController@getSalidasLlegadas')->middleware(['auth']);
    Route::get('/getocupacion', 'ReservacionesController@getOcupacion')->middleware(['auth']);
    Route::get('/getpersonas', 'ReservacionesController@getPersonas')->middleware('auth');
    Route::get('/fillOcupacionSelect', 'ReservacionesController@fillOcupacionSelect')->middleware('auth');
    Route::get('/getbalanceprecio', 'ReservacionesController@getBalancePrecio')->middleware('auth');
});

Route::group(['prefix' => 'comisionistas'], function () {

    Route::get('/','ComisionistaController@index')->middleware('auth');
    Route::get('/all', 'ComisionistaController@getComisionistas')->middleware('auth');
    Route::post('/', 'ComisionistaController@crear')->middleware('auth');
    Route::put('/{comisionistaId}', 'ComisionistaController@update')->middleware('auth');

});


Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');


Route::resource('/usuarios', 'UsersController')->middleware(['auth']);

Route::get('register', function(){
    return view('auth.login');
});

Route::resource('tipounidades', 'TipoUnidadController')->middleware(['auth']);

Route::get('unidades', function(){
    return view('sub-sections.equiposyunidades');
});

//test
Route::resource('test', 'testController');

// tipo unidaddes controller
Route::resource('unidades', 'EquiposYUnidadesController')->middleware(['auth']);



//tipo de actividades
Route::resource('tipoactividades', 'TipoActividadesController')->middleware(['auth']);

Route::put('editar-actividad/{id}', 'ActividadesController@updateActividad')->middleware(['auth']);
Route::put('deshabilitar-actividad/{id}', 'ActividadesController@deshabilitarActividad')->middleware(['auth']);
Route::get('status-actividad/{id}','ActividadesController@statusActividad')->middleware(['auth']);
Route::resource('actividades', 'ActividadesController')->middleware(['auth']);


Route::get('salidasllegadas','ActividadesController@salidasllegadas')->middleware(['auth']);
Route::get('horario-multiple/{id}','ActividadesController@horarioMultiple')->middleware(['auth']);

Route::get('asignaciones/info-actividad-horario/{id}','AsignacionesController@actividadHorarioInfo')->middleware(['auth']);

Route::get('asignaciones-get','AsignacionesController@getAsignaciones');
Route::get('asignaciones/salidas-llegadas/{id}','AsignacionesController@salidasLlegadas');

Route::resource('asignaciones' , 'AsignacionesController')->middleware(['auth']);

Route::get('info-actividad/{id}', 'CombosController@infoactividad')->middleware(['auth']);
Route::put('desactivarcombo/{id}', 'CombosController@desactivarcombo')->middleware(['auth']);
Route::resource('combos', 'CombosController')->middleware(['auth']);
