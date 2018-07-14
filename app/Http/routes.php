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
//esto nos permite indicar donde se almacenan los procedimientos como insert,update, etc.
Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('compras/proveedor','ProveedorController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('ventas/venta','VentaController');
Route::resource('seguridad/usuario','UsuarioController');
Route::auth();
	
Route::get('/home', 'HomeController@index');
Route::get('/reporte_cliente','PdfController@pdf_cliente');
Route::get('/reporte_articulo','PdfController@pdf_articulo');
Route::get('/reporte_categoria','PdfController@pdf_categoria');
Route::get('/reporte_ingreso','PdfController@pdf_ingreso');
Route::get('/reporte_proveedor','PdfController@pdf_proveedor');
Route::get('/reporte_venta','PdfController@pdf_venta');
Route::get('/reporte_user','PdfController@pdf_user');
Route::get('/help','PdfController@pdf_ayuda');


//esto es por si la ruta no existe o no es una de las anteriores
Route::get('/{slug?}', 'HomeController@index');
