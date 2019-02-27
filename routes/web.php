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
    return view('desktop.reservaciones');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('usuarios', 'UsersController');

