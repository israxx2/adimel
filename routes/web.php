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

    $productos= DB::table('PRODUCTOS')->paginate(15);

	$categorias = DB::table('RUBRO')
	->where([
		['rub_estado', 1],
		['rub_idn', '!=', 0],
		['rub_idn', '!=', 8],
	])->get();

	return view('cliente.index-3')
    ->with('categorias', $categorias)
    ->with('productos', $productos);

});

Route::get('/mercadoPublico', function () {
	$categorias = DB::table('RUBRO')
	->where([
		['rub_estado', 1],
		['rub_idn', '!=', 0],
		['rub_idn', '!=', 8],
	])->get();
	return view('cliente.mercado-publico')
	->with('categorias', $categorias);
});

Route::get('/quienes-somos', function () {
	$categorias = DB::table('RUBRO')
	->where([
		['rub_estado', 1],
		['rub_idn', '!=', 0],
		['rub_idn', '!=', 8],
	])->get();

	return view('cliente.about_us')
	->with('categorias', $categorias);
});

Route::get('/contacto', function () {
	$categorias = DB::table('RUBRO')
	->where([
		['rub_estado', 1],
		['rub_idn', '!=', 0],
		['rub_idn', '!=', 8],
	])->get();

	return view('cliente.contact')
	->with('categorias', $categorias);
});

Route::get('/viewProduct/{id}', function ($id) {

    //0000003070147
    $productos= DB::table('PRODUCTOS')
    ->where([
		['pro_idn', $id],
	])->get();

    $categorias = DB::table('RUBRO')
	->where([
		['rub_estado', 1],
		['rub_idn', '!=', 0],
		['rub_idn', '!=', 8],
	])->get();

    return view('cliente.single-product')
    ->with('categorias', $categorias)
    ->with('productos', $productos);
});

Route::group(['prefix' => 'admin'], function(){

	Route::get('/', function () {
		return view('admin.home');
	})->name('admin');

	//Productos
	Route::get('/productos', 'Admin\ProductoController@index')->name('admin.productos.index');

	//Usuarios
	Route::resource('producto', 'Admin\ProductoController', ['names' => [
		'index' 	=> 'admin.producto.index',
		'create' 	=> 'admin.producto.create',
		'store' 	=> 'admin.producto.store',
		'destroy' 	=> 'admin.producto.destroy',
		'show' 		=> 'admin.producto.show',
		'edit' 		=> 'admin.producto.edit',
		'update' 	=> 'admin.producto.update',
	]]);

		//Imagenes
		Route::get('imagen', 'Admin\ProductoController@imagenes');

		Route::post('imagen', 'Admin\ProductoController@imageCropPost');
});