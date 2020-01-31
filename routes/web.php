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
use App\Funcionario;
use Illuminate\Support\Facades\Auth;

//////////////////////////
//// AUTH ADMIN		//////
//////////////////////////
Route::get('/adimel-login', 'Auth\LoginController@adimelLogin')->name('login_view');
Route::post('/funcionario/login', 'Auth\LoginController@funcionarioLogin')->name('funcionario.login');
Route::post('/cliente/login', 'Auth\LoginController@clienteLogin')->name('cliente.login');
Route::post('/cliente/logout', 'Cliente\LoginController@clienteLogout')->name('cliente.logout');
Route::get('/nueva-cuenta', 'Cliente\LoginController@viewCreateAccount')->name('cliente.create_account');
Route::post('/nueva-cuenta', 'Cliente\LoginController@storeCreateAccount')->name('cliente.create_account.store');

//////////////////////////
//// CLIENTE	    //////
//////////////////// /////
Route::get('/', 'Cliente\GeneralController@inicio')->name('cliente.inicio');
Route::get('/mercadoPublico', 'Cliente\GeneralController@mercadoPublico');
Route::get('/quienes-somos', 'Cliente\GeneralController@quienesSomos');
Route::get('/contacto', 'Cliente\GeneralController@viewContacto');
Route::get('/cart', 'Cliente\GeneralController@cart');
Route::get('/checkout', 'Cliente\GeneralController@checkout');
Route::get('/viewProduct/{id}', 'Cliente\GeneralController@viewProduct');
Route::get('/categoria/{id}', 'Cliente\GeneralController@categoria');
Route::post('/cliente/direccion', 'Cliente\GeneralController@nuevaDireccion')->name('cliente.direccion');

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

	$dep = DB::table('DEPENDENCIAS_DEL_CLIENTE')
	->where('cli_idn', '19105900-K')
	->get();
	dd($dep);
	$users = DB::table('FUNCIONARIOS')
	->take('10')
	->get();

	
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

Route::get('/asd', function() {

	//Helper para ver Configuracion

	/* Método get(string)
	* Entrada: Id de la configuracion
	* Salida: Instancia de la configuración
	*/
	// $configuracion = Config::get('email');
	// dd($configuracion);

	//Crear Nueva Configuracion (Llamar al Modelo Configuración)

	$configuracion = new App\Configuracion();

	//id
	$configuracion->conf_idn 			= 'facebook';
	
	//Value del Campo
	$configuracion->titulo 				= 'www.facebook.com/adimel';
	
	//Rut de la ultima persona que modifico
	$configuracion->modificado_por 		= '19105900-K';
	
	//Estado de la configuracion (1 por defecto)
	//$configuracion->estado 				= 1;

	//Guardar Configuración
	//$configuracion->save();


	$configuracion = new App\Configuracion();
	$configuracion->conf_idn 			= 'correo';
	$configuracion->titulo 				= 'www.facebook.com/adimel';
	$configuracion->modificado_por 		= '19105900-K';
});

Route::get('/asdf', function() {


	
	
	$iva = DB::table('IVA')->where('iva_activo', 1)->first();


	$ord_ven_idn = DB::table('CORRELATIVOS')->select('*')->where('corre_tipo', 29)->first()->corre_correlativo;
	
	//dd(DB::table('ORDEN_DE_VENTA')->where('ord_ven_idn',(string)$a)->first());

	$dep_cli_idn = Auth::guard('cliente')->id();
	$fun_rut = '148';
	$iva_idn = $iva->iva_idn;
	$ven_idn = '0'; //ID WEB --EDITAR //solo acepta enteros
	$tip_ven_idn = '5';
	$rec_idn = '1';
	$ord_ven_neto = 999; //Total de la compra
	$ord_ven_iva = 9; //Calcular iva del total
	$tipo = '1';
	$ord_ven_num_ordcom = '0';
	$fecha_ingreso = date( 'Y-m-d');


	DB::table('ORDEN_DE_VENTA')
	->insert([
		['ord_ven_idn' 				=> "153855"],
		['dep_cli_idn' 				=> $dep_cli_idn],
		["ord_ven_descuento"		=> "0"],
		["tip_doc_idn"				=> "0"],
		['ord_ven_fecha_ingreso'	=>	"000"],
		['iva_idn' 					=> $iva_idn],
		["ord_ven_total_venta"		=> "170"],
		["for_pag_idn"				=> "1"],
		["ord_ven_cajero"			=> 0],
		["ord_ven_estado"			=> 0],
		["ord_ven_rut_retira"		=> "0"],
		["ord_ven_nombre_retira"	=> "0"],
		["pla_pag_idn"				=> "100"],
		["ord_ven_aju_din"			=> "0"],
		["ord_ven_dinero"			=> 0],
		["ord_ven_des_pesos"		=> "0"],
		["ven_idn_comi"				=> "0"],
		["ord_tra_idn"				=> ""],
		["emp_idn"					=> "1"],
		["ord_ven_valor_exento"		=> 0],
		["fecha_entrega"			=> strtotime($fecha_ingreso)],
		["comentario"				=> 0],
		["reserva"					=> "0"],
		["tip_des_idn"				=> 0],
		["tip_tras_idn"				=> 0],
		["cot_idn"					=> "0"],
		["dias"						=> "0"],
		["fecha_vencimiento"		=> strtotime($fecha_ingreso)],
		["ord_ven_reservado"		=> 0],
		["ord_ven_cot_idn"			=> 0],
		['fun_rut' 					=> $fun_rut],
		['ven_idn' 					=> $ven_idn],
		['tip_ven_idn' 				=> $tip_ven_idn],
		['rec_idn' 					=> $rec_idn],
		['ord_ven_neto' 			=> $ord_ven_neto],
		['ord_ven_iva' 				=> $ord_ven_iva],
		['ord_ven_num_ordcom' 		=> $ord_ven_num_ordcom],
		['tipo' 					=> $tipo]
	]);

	dd("entro");



	// $carrito = Carrito::all();
	// dd($carrito);
	// dd(Auth::guard('cliente')->id());
	// //Los helpers: App\Helpers
	// //Ahí puedes hecharle un ojo
	
	// Prod::all(); //Retorna todos los productos
	// Prod::all('50'); //Retorna todos los productos filtrados por una FAMILIA (fam_idn)
	// Prod::get('4711421815062')->familia; //Ver Familia de un Producto

	// Fam::all(); //retorna todas las Familias
	// Fam::get('50'); //Retorna la Familia con fam_idn 50
	// Fam::get('50')->productos; //Retorna los productos de esa Familia

});

