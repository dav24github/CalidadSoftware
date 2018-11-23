<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::resource('almacen/categoria','CategoriaController'); //grupo de peticion CRUD
Route::resource('almacen/articulo','ArticuloController'); //grupo de peticion CRUD
Route::resource('ventas/cliente','ClienteController'); //grupo de peticion CRUD
Route::resource('compras/proveedor','ProveedorController'); //grupo de peticion CRUD
Route::resource('compras/ingreso','IngresoController'); //grupo de peticion CRUD
Route::resource('ventas/venta','VentaController'); //grupo de peticion CRUD

Route::resource('seguridad/usuario','UsuarioController'); //grupo de peticion CRUD

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/{slug?}', 'HomeController@index');