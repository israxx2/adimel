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
use Illuminate\Support\Facades\DB;

Route::get('/', function () {

	//dd(DB::table('PRODUCTOS')->get());
	$categorias = DB::table('RUBRO')
	->where([
		['rub_estado', 1],
		['rub_idn', '!=', 0],
		['rub_idn', '!=', 8],
	])->get();

	return view('cliente.index-3')
	->with('categorias', $categorias);

});

Route::get('/mercadoPublico', function () {
    return view('cliente.mercado-publico');
});

Route::get('/quienes-somos', function () {
    return view('cliente.about_us');
});

Route::get('/contacto', function () {
    return view('cliente.contact');
});

Route::group(['prefix' => 'admin'], function(){

	Route::get('/', function () {
		return view('admin.home');
	})->name('admin');

	//Productos
	Route::get('/productos', 'Admin\ProductoController@index')->name('admin.productos.index');
	
});