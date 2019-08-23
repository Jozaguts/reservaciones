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

Route::get('/reservaciones', function () {
    return view('sections.reservations');
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
Route::resource('combos', 'CombosController')->middleware(['auth']);

//tipo de actividades
Route::resource('tipoactividades', 'TipoActividadesController')->middleware(['auth']);

Route::put('editar-actividad/{id}', 'ActividadesController@updateActividad')->middleware(['auth']);
Route::put('deshabilitar-actividad/{id}', 'ActividadesController@deshabilitarActividad')->middleware(['auth']);
Route::get('status-actividad/{id}','ActividadesController@statusActividad')->middleware(['auth']);
Route::resource('actividades', 'ActividadesController')->middleware(['auth']);


Route::get('salidasllegadas','ActividadesController@salidasllegadas')->middleware(['auth']);
Route::get('horario-multiple/{id}','ActividadesController@horarioMultiple')->middleware(['auth']);

Route::get('info-actividad/{id}', 'CombosController@infoactividad')->middleware(['auth']);

// Route::get('asignaciones',function(){
//     return view('sections.activities.asignaciones');
// });
// Route::get('asignaciones' , 'AsignacionesController@index')->middleware(['auth']);
// Route::get('asignaciones-get' , 'AsignacionesController@getAsignaciones');
Route::resource('asignaciones' , 'AsignacionesController')->middleware(['auth']);

Route::get('asignaciones-get','AsignacionesController@getAsignaciones');
