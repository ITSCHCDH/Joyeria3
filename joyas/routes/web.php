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
//Ruta de inisio del sistema
Route::get('/', function () {    
     return view('auth.login');
})->name('logeo');

//Ruta para registrar usuarios
Route::get('/registro',function(){
	if(Auth::guard('web')->check()){
	return view('auth.register');
	}
})->name('registro');

//Ruta para consulta de usuarios
Route::get('/usuarios',function(){
	if(Auth::guard('web')->check()){
		return view('Admin.usuarios');
	}
})->name('usuarios');



Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


