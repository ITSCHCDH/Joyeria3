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
	//Rutas del controlador de usuarios
	Route::get('/usuarios/index','UsuariosController@index')->name('usuarios');
	Route::get('/usuarios/{id}/update','UsuariosController@update')->name('usuarios.update');
	Route::get('/usuarios/{id}/destroy','UsuariosController@destroy')->name('usuarios.destroy');

	//Rutas del controlador de articulos
	Route::get('/articulos/index','ArticulosController@index')->name('articulos.index');
	Route::get('/articulos/store/{id_cat}/{id_pro}','ArticulosController@store')->name('articulos.store');
	Route::get('/articulos/{id}/destroy','ArticulosController@destroy')->name('articulos.destroy');
	Route::get('/articulos/{id}/update','ArticulosController@update')->name('articulos.update');

	//Rutas del controlador de categorias
	Route::get('/categorias/index','CategoriasController@index')->name('categorias.index');
	Route::get('/categorias/store','CategoriasController@store')->name('categorias.store');
	Route::get('/categorias/{id}/actualizar','CategoriasController@update')->name('categorias.actualizar');
	Route::get('/categorias/{id}/eliminar','CategoriasController@destroy')->name('categorias.eliminar');
	//Rutas del controlador de proveedores
	Route::get('/proveedores/index','ProveedoresController@index')->name('proveedores.index');
	Route::get('/proveedores/store','ProveedoresController@store')->name('proveedores.store');
	Route::get('/proveedores/{id}/actualizar','ProveedoresController@update')->name('proveedores.actualizar');
	Route::get('/proveedores/{id}/eliminar','ProveedoresController@destroy')->name('proveedores.eliminar');
	//Rutas del controlador de inversionistas
	Route::get('/inversionistas/index','InversionistasController@index')->name('inversionistas.index');
	Route::get('/inversionistas/store','InversionistasController@store')->name('inversionistas.store');
	Route::get('/inversionistas/{id}/actualizar','InversionistasController@update')->name('inversionistas.actualizar');
	Route::get('/inversionistas/{id}/eliminar','InversionistasController@destroy')->name('inversionistas.eliminar');
	//Rutas del controlador de inversiones
	Route::get('/inversiones/index','InversionesController@index')->name('inversiones.index');
	Route::get('/inversiones/{id_i}/store','InversionesController@store')->name('inversiones.store');
	Route::get('/inversiones/{id}/actualizar/{inv}','InversionesController@update')->name('inversiones.actualizar');
	Route::get('/inversiones/{id}/eliminar','InversionesController@destroy')->name('inversiones.eliminar');
	//Rutas de controlador de ventas
	Route::get('/ventas/index','VentasController@index')->name('ventas.index');
	Route::post('/ventas/artVentas','VentasController@store')->name('ventas.artVentas');	
	//Rutas de controlador de reglas
	Route::get('/reglas/index','ReglasController@index')->name('reglas.index');
	Route::get('/reglas/store','ReglasController@store')->name('reglas.store');
	Route::get('/reglas/{id}/actualizar','ReglasController@update')->name('reglas.actualizar');
	//Rutas de controlador de Estado de cuenta
	Route::get('/corte/index','Estado_CuentaController@index')->name('corte.index');
	Route::get('/corte/store','Estado_CuentaController@store')->name('corte.store');
	Route::get('/corte/{id}/actualizar','Estado_CuentaController@update')->name('corte.actualizar');
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
