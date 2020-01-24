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
use App\Funcionario;
use Illuminate\Support\Facades\Auth;

//Autentificacion
Route::get('/adimel-login', 'Auth\LoginController@adimelLogin')->name('login_view');
Route::post('/funcionario/login', 'Auth\LoginController@funcionarioLogin')->name('funcionario.login');
Route::post('/cliente/login', 'Auth\LoginController@clienteLogin')->name('cliente.login');
Route::post('/cliente/logout', 'Cliente\GeneralController@clienteLogout')->name('cliente.logout');
Route::get('/nueva-cuenta', 'Cliente\GeneralController@viewCreateAccount')->name('cliente.create_account');
Route::post('/nueva-cuenta', 'Cliente\GeneralController@storeCreateAccount')->name('cliente.create_account.store');

//////////////////////////
//// ADIMEL Cliente //////
//////////////////////////

Route::get('/', 'Cliente\GeneralController@inicio')->name('cliente.inicio');
Route::get('/mercadoPublico', 'Cliente\GeneralController@mercadoPublico');
Route::get('/quienes-somos', 'Cliente\GeneralController@quienesSomos');
Route::get('/contacto', 'Cliente\GeneralController@viewContacto');
Route::get('/cart', 'Cliente\GeneralController@cart');
Route::get('/checkout', 'Cliente\GeneralController@checkout');
Route::get('/viewProduct/{id}', 'Cliente\GeneralController@viewProduct');
Route::get('/categoria/{id}', 'Cliente\GeneralController@categoria');


////////////////////////////////
//// ADIMEL Administrador //////
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
	Route::get('/configuracion', 'Admin\GeneralController@configuracion')->name('admin.configuracion.index');
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


	// $dep = DB::table('CLIENTE')
	// ->where('cli_idn', '13100907-0')
	// ->get();
	// dd($dep);

	// CLIENTE
	// +"cli_idn": "13100907-0"
	// +"cli_rut": "13.100.907-0"
	// +"cli_razon_social": "BERNARDO GUTIERREZ"
	// +"cli_giro": "PARTICULAR"
	// +"cli_traslado": "0"

	// DEPENDENCIAS_DEL_CLIENTE
	// "dep_cli_idn" => "1"
	// "cli_idn" => "13100907-0"
	// "dep_cli_nombre" => "BERNARDO GUTIERREZ"
	// "cli_giro" => "PARTICULAR"
	// "dep_cli_direccion" => "8 OTE 245"
	// "seg_div_pol_idn" => "100"
	// "dep_cli_fono" => "617449"
	// "dep_cli_fax" => ""
	// "dep_cli_casilla" => "-"
	// "dep_cli_enc_atencion" => " "
	// "cat_idn" => "100"
	// "zon_idn" => "100"
	// "dep_cli_descuento" => "0.0"
	// "ven_idn" => "N"
	// "dep_cli_email" => "CRISOL@MACROHARD.CL"
	// "dep_cli_web" => "-"
	// "por_uti_idn" => "1"
	// "dep_cli_fecha_ingreso" => "2016-05-02 00:00:00"
	// "dep_cli_estado" => "1"
	// "dep_cli_monaut" => "0"
	// "pla_pag_idn" => "100"
	// "for_pag_idn" => "1"
	// "dep_cli_saldo_favor" => "0"
	// "dep_cli_ciudad" => "TALCA"
	// "dep_plazo_pago" => "0"
	// "dep_cli_usuario_web" => null
	// "dep_cli_clave_web" => null
});

Route::get('/oferta', function() {
	$o = DB::table('DESCUENTO_PRODUCTO')
	->take('10')->get();

	dd($o);

	// +"des_pro_idn": "101"
	// +"pro_idn": "98"
	// +"des_pro_precio": "1200.0"
	// +"des_pro_estado": "0"
	// +"des_pro_fecha_inicio": "2016-06-07 00:00:00"
	// +"des_pro_fecha_termino": "2016-06-30 00:00:00"
	// +"des_pro_fecha_ingreso": "2016-06-07 14:55:00"
	// +"des_pro_stock": "2.0"
	// +"pro_codigo": "78020040"
	
	/*
	



	*/
});

Route::get('/asd', function() {

	//Helper para ver Configuracion

	/* Método get(string)
	* Entrada: Id de la configuracion
	* Salida: Instancia de la configuración
	*/
	$configuracion = Config::get('email');
	dd($configuracion);

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
});