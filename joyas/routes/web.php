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
//Route::get('Admin/usuarios/index','UsuariosController@index')->name('usuarios')->middleware('auth'); //Ruta individual
//Sintaxis //Route //Clase para usar las rutas::middleware('auth:api')//Proteccion de la ruta pra que no acepte llamadas sin autenticar->get//Metodo de http('Admin/usuarios/index'//URL,'UsuariosController@index'//Controlador al que hace referencia)->name('usuarios')//Nombre de la ruta;

Route::group(['prefix'=>'Admin', 'middleware' => 'auth'],function(){
	Route::get('/usuarios/index','UsuariosController@index')->name('usuarios');

	//Rutas del controlador de articulos
	Route::get('/articulos/index','ArticulosController@index')->name('articulos.index');
	Route::get('/articulos/create','ArticulosController@create')->name('articulos.create');

	//Rutas del controlador de categorias
	Route::get('/categorias/index','CategoriasController@index')->name('categorias.index');
	Route::get('/categorias/store','CategoriasController@store')->name('categorias.store');
	Route::get('/categorias/{id}/actualizar','CategoriasController@actualizar')->name('categorias.actualizar');
	Route::post('/categorias/{id}/eliminar','CategoriasController@eliminar')->name('categorias.eliminar');

});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
