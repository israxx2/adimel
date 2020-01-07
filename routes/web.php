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
use App\User;

Auth::routes(['register' => false]);


Route::get('/', 'Cliente\GeneralController@inicio');

Route::get('/mercadoPublico', 'Cliente\GeneralController@mercadoPublico');

Route::get('/quienes-somos', 'Cliente\GeneralController@quienesSomos');

Route::get('/contacto', 'Cliente\GeneralController@contacto');

Route::get('/cart', 'Cliente\GeneralController@cart');

Route::get('/checkout', 'Cliente\GeneralController@checkout');

Route::get('/viewProduct/{id}', 'Cliente\GeneralController@viewProduct');

Route::get('/categoria/{id}', 'Cliente\GeneralController@categoria');

Route::get('/nueva-cuenta', 'Cliente\GeneralController@createAccount')->name('cliente.create_account');


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

Route::get('/test', function () {
	$users = User::all()->take('10');
	dd($users);


	$dep = DB::table('CLIENTE')->get();
	dd($dep[1]);

	$dep = DB::table('DEPENDENCIAS_DEL_CLIENTE')
	->where('cli_idn', '04065059-8')
	->get();
	dd($dep);
});
