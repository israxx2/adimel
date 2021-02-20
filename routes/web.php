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
use App\Carrito;
use App\Producto;
use App\Funcionario;
use App\Mail\RecuperarContrasena;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

//////////////////////////
//// AUTH ADMIN		//////
//////////////////////////
Route::get('/adimel-login', 'Auth\LoginController@adimelLogin')->name('login_view');
Route::post('/funcionario/login', 'Auth\LoginController@funcionarioLogin')->name('funcionario.login');
Route::post('/cliente/login', 'Auth\LoginController@clienteLogin')->name('cliente.login');
Route::post('/cliente/logout', 'Cliente\LoginController@clienteLogout')->name('cliente.logout');
Route::get('/nueva-cuenta', 'Cliente\LoginController@viewCreateAccount')->name('cliente.create_account');
Route::post('/nueva-cuenta', 'Cliente\LoginController@storeCreateAccount')->name('cliente.create_account.store');
Route::post('/recuperar', 'Cliente\LoginController@recuperarClave')->name('cliente.recuperar');
//////////////////////////
//// CLIENTE	    //////
//////////////////// /////
Route::get('/', 'Cliente\GeneralController@inicio')->name('cliente.inicio');
Route::get('/perfil', 'Cliente\GeneralController@perfil')->name('cliente.perfil');
Route::get('/mercadoPublico', 'Cliente\GeneralController@mercadoPublico');
Route::get('/quienes-somos', 'Cliente\GeneralController@quienesSomos');
Route::get('/contacto', 'Cliente\GeneralController@viewContacto');
Route::get('/cart', 'Cliente\GeneralController@cart');
Route::get('/checkout', 'Cliente\GeneralController@checkout');
Route::post('/efectuarcompra', 'Cliente\CarritoController@efectuarcompra');
Route::get('/viewProduct/{id}', 'Cliente\GeneralController@viewProduct');
Route::get('/categoria/{id}', 'Cliente\GeneralController@categoria');
Route::post('/cliente/direccion', 'Cliente\GeneralController@nuevaDireccion')->name('cliente.direccion');
Route::get('/cliente/recuperar-contrasena/{id}/{token}', 'Cliente\LoginController@recuperarClave2')->name('cliente.recuperar_contrasena_token');
Route::post('/recuperar-contrasena', 'Cliente\LoginController@recuperarClave3')->name('cliente.recuperar_contrasena.store');

//////////////////////
//// CARRITO	//////
//////////////////////
Route::get('/getCarrito', 'Cliente\CarritoController@getCarrito');
Route::post('/addCarrito', 'Cliente\CarritoController@addCarrito');
Route::post('/deleteCarrito', 'Cliente\CarritoController@deleteCarrito');
Route::post('/editCarrito', 'Cliente\CarritoController@editCarrito');



////////////////////////////////
//// ADMINISTRADOR		  //////
////////////////////////////////

Route::group(['prefix' => 'adimel'], function(){

	Route::get('/', function () {
		return view('admin.home');
	})->name('admin');
	//Productos
	Route::get('/productos', 'Admin\GeneralController@index')->name('admin.productos.index');
	//ofertas
	Route::get('/ofertas', 'Admin\GeneralController@ofertas')->name('admin.ofertas.index');
	//mercado
	Route::get('/mercado', 'Admin\GeneralController@mercado')->name('admin.mercado.index');
	//uploadfile Mercado Publico
	Route::post('/uploadfile', 'Admin\GeneralController@UploadFile');
	//Imagenes
	Route::get('imagen', 'Admin\GeneralController@imagenes');
	Route::post('imagen', 'Admin\GeneralController@imageCropPost');
	Route::post('/funcionario/logout', 'Admin\GeneralController@funcionarioLogout')->name('funcionario.logout');
	//Configuracion
	Route::get('/configuracion', 'Admin\ConfiguracionController@index')->name('admin.configuracion.index');
	Route::post('/configuracion', 'Admin\ConfiguracionController@store')->name('admin.configuracion.store');

	Route::resource('producto', 'Admin\GeneralController', ['names' => ['edit' => 'admin.producto.edit']]);


});



//////////////////////
//// Rutas test //////
//////////////////////
Route::get('/test', function () {
	// dd(Auth::guard('cliente')->user());

	$user = User::find(6347);
	dd($user);
	// $dep = DB::table('CLIENTE')
	// ->where('cli_idn', '6347')
	// ->take('100')
	// ->get();

	// $dep = DB::table('DEPENDENCIAS_DEL_CLIENTE')
	// ->where('cli_idn', '10156855-5')
	// ->get();

	$dep = DB::table('DEPENDENCIAS_DEL_CLIENTE')->where('dep_cli_idn', 6347)->get();
	dd($dep);
	$users = DB::table('FUNCIONARIOS')
	->take('10')
	->get();

	// 89505200-0 (3)
	// 90380000-3 (2)
	// 93281000-K (3)
	// 69100100-8 (4)
	
	dd(Auth::guard('funcionario')->user());
	Auth::guard('funcionario')->logout();
	return redirect('/');
	$funcionario = Funcionario::find(144);
	dd($funcionario);
	$funcionario->password = bcrypt('13-2-912');
	$funcionario->save();
	$funcionario = Funcionario::take('10')->get();
	dd($funcionario);

	Auth::guard('funcionario')->setUser($funcionario);
	
	dd(Auth::guard('funcionario')->user()->fun_nombre);
	$dep = DB::table('DEPENDENCIAS_DEL_CLIENTE')
	->where('cli_idn', '19105900-K')
	->get();
	
	
	//metodos para el cliente logueado
	// Auth::guard('cliente')->user()     --Retorna al usuario logueado
	// Auth::guard('cliente')->id()       --Retorna la id
	// Auth::guard('cliente')->check()    --Retorna true si alguien ta logueado
	// Auth::guard('cliente')->logout()   --Desloguea obviamente


	$user = User::find(6347);
	dd($user);
	$user->password = bcrypt('asdqwe123');
	dd($user->save());
	dd(Auth::check());
	// $users = DB::table('DEPENDENCIAS_DEL_CLIENTE')->take('10')->get();
	$users = DB::table('DEPENDENCIAS_DEL_CLIENTE')->where('dep_cli_idn', 6347)->get();
	dd($users);

});

Route::get('/oferta', function() {
	$o = DB::table('REGION')
	->take('100')->get();

	dd($o);

});


Route::get('recuper-contraseña', function(Request $request) {
	//$rut = '19105900-K';

});