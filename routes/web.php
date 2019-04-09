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



// tipo unidaddes controller 
Route::resource('unidades', 'EquiposYUnidadesController')->middleware(['auth']);

//tipo de actividades
Route::resource('tipoactividades', 'TipoActividadesController')->middleware(['auth']);


Route::resource('actividades', 'ActividadesController')->middleware(['auth']);

