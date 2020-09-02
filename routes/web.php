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
	dd(Auth::guard('cliente')->user());
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

	$a = Funcionario::all();

	dd($a);
	
	
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



Route::get('/aaa', function() {


	$correlativo1 = DB::table('CORRELATIVOS')->where('corre_tipo', '29')->first();
	$correlativo2 = DB::table('CORRELATIVOS')->where('corre_tipo', '45')->first();
	$ord_ven_idn 		= $correlativo1->corre_correlativo + 1;
	$det_ord_ven_idn 	= $correlativo2->corre_correlativo + 1;

	$iva = DB::table('IVA')->where('iva_activo', '1')->first();
	$valor_iva = $iva->IVA;
	$iva_idn = $iva->iva_idn;

	$user 		 = Auth::guard('cliente')->user();
	$dep_cli_idn = $user->dep_cli_idn;

	$ven_idn = 'WW';

	$tip_ven_idn = '1'; //5

	$rec_idn = '1';

	$ord_ven_neto = 10000; //Total de la venta

	$ord_ven_iva = ($ord_ven_neto * $valor_iva); //Total venta + iva

	$ord_ven_num_ordcom = '0';

	$tipo = '1';

	$parametros = [
		strval($ord_ven_idn),   // @ord_ven_idn
		'99.999.999-9',			// @fun_rut (funcionario web)
		$iva_idn, 				// @iva_idn
		$dep_cli_idn,			// @dep_cli_idn
		$ven_idn,				// @ven_idn
		$tip_ven_idn,			// @tip_ven_idn
		$rec_idn,				// @rec_idn
		$ord_ven_neto,			// @ord_ven_neto
		$ord_ven_iva,			// @ord_ven_iva
		$ord_ven_num_ordcom,	// @ord_ven_num_ordcom
		$tipo 					// @tipo
	];
	DB::update('exec dbo.orden_de_venta_asigna ?,?,?,?,?,?,?,?,?,?,?', $parametros);

	DB::table('CORRELATIVOS')
	->where('corre_tipo', '29')
	->update(['corre_correlativo' => strval($ord_ven_idn)]);
	
	$productos_carrito = App\Carrito::where('dep_cli_idn', $dep_cli_idn)->get();

	foreach($productos_carrito as $pc) {

		$pro = Producto::find($pc->prod_codigo);

		$parametros = [
			strval($det_ord_ven_idn),   		// @det_ord_ven_idn
			strval($ord_ven_idn),				// @ord_ven_idn
			$pro->pro_idn, 						// @pro_idn
			$pc->cantidad,						// @det_ord_ven_cantidad
			$dcto,								// @det_ord_ven_descuento
			$precio,							// @det_ord_ven_valor
			'148',								// @fun_idn (funcionario web)
			0,									// @det_ord_ven_can_pen           ?????????
			$user->cat_idn,						// @det_ord_ven_lista
			0,									// @det_tipo_proseso
			'99.999.999-9', 					// @fun_rut_aut
			'1', 								// @por_uti_idn
			$total, 							// @det_ord_ven_total
			$total - ($pro->pro_costo + $iva),	// @det_ord_ven_valor_comi
			$pro->pro_codigo,					// @pro_codigo codigo producto
			$pro->pro_aux, 						// @pro_aux
			$pro->pro_nombre,					// @pro_nombre
			$pro->pro_stock,					// @stock_anterior
		];

		DB::update('exec dbo.detalle_orden_de_venta_agrega ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $parametros);

		DB::table('CORRELATIVOS')
		->where('corre_tipo', '45')
		->update(['corre_correlativo' => strval($det_ord_ven_idn)]);

		$det_ord_ven_idn++;
	}

	echo "Id Factura: ". $ord_ven_idn;
	echo "Id Detalle: ". $det_ord_ven_idn;
	return 1;
});


Route::get('prod', function () {

	$correlativo1 = DB::table('CORRELATIVOS')->where('corre_tipo', '29')->first();
	$correlativo2 = DB::table('CORRELATIVOS')->where('corre_tipo', '45')->first();
	$ord_ven_idn 		= $correlativo1->corre_correlativo + 1;
	$det_ord_ven_idn 	= $correlativo2->corre_correlativo + 1;

	$iva = DB::table('IVA')->where('iva_activo', '1')->first();
	$valor_iva = $iva->IVA;
	$iva_idn = $iva->iva_idn;

	$user 		 = Auth::guard('cliente')->user();
	$dep_cli_idn = $user->dep_cli_idn;

	$ven_idn = 'WW';

	$tip_ven_idn = '1'; //5

	$rec_idn = '1';

	$ord_ven_neto = 10000; //Total de la venta

	$ord_ven_iva = ($ord_ven_neto * $valor_iva); //Total venta + iva

	$ord_ven_num_ordcom = '0';

	$tipo = '1';

	$parametros = [
		strval($ord_ven_idn),   // @ord_ven_idn
		'99.999.999-9',			// @fun_rut (funcionario web)
		$iva_idn, 				// @iva_idn
		$dep_cli_idn,			// @dep_cli_idn
		$ven_idn,				// @ven_idn
		$tip_ven_idn,			// @tip_ven_idn
		$rec_idn,				// @rec_idn
		$ord_ven_neto,			// @ord_ven_neto
		$ord_ven_iva,			// @ord_ven_iva
		$ord_ven_num_ordcom,	// @ord_ven_num_ordcom
		$tipo 					// @tipo
	];
	
	// DB::update('exec dbo.orden_de_venta_asigna ?,?,?,?,?,?,?,?,?,?,?', $parametros);

	// DB::table('CORRELATIVOS')
	// ->where('corre_tipo', '29')
	// ->update(['corre_correlativo' => strval($ord_ven_idn)]);
	
	$productos_carrito = App\Carrito::where('dep_cli_idn', $dep_cli_idn)->get();

	// "prod_codigo" => "78020040"
	// "prod_nombre" => "EL MEDICO A PALOS, EDIT. ERCILLA"

	// "prod_codigo" => "7806505018365"
	// "prod_nombre" => "CUAD. TORRE UNIV. CLASICO POOH MAT. 7 MM. 100 HJS. 25344"

	// "prod_codigo" => "001561"
	// "prod_nombre" => "JUEGO ENCAJE MADERA TORRE ANIMALES "

	// "prod_codigo" => "7806505018365"
	// "prod_nombre" => "CUAD. TORRE UNIV. CLASICO POOH MAT. 7 MM. 100 HJS. 25344"

	
	foreach($productos_carrito as $pc) {

		$pro = Producto::find($pc->prod_codigo);

		$dcto = null;
		$valor = null;
		switch ($user->por_uti_idn) {
			case '1':
			$dcto 	= $pro->pro_porcen1;
			$valor 	= $pro->pro_valor_venta1;
			case '2':
			$dcto 	= $pro->pro_porcen2;
			$valor 	= $pro->pro_valor_venta2;
			case '3':
			$dcto = $pro->pro_porcen3;
			$valor 	= $pro->pro_valor_venta3;
			case '4':
			$dcto = $pro->pro_porcen4;
			$valor 	= $pro->pro_valor_venta4;
			case '5':
			$dcto = $pro->pro_porcen5;
			$valor 	= $pro->pro_valor_venta5;
			default:
			$dcto = $pro->pro_porcen1;
			$valor 	= $pro->pro_valor_venta1;
		}

		$valor_con_iva = $valor_iva * $valor;

		$parametros = [
			strval($det_ord_ven_idn),   		// @det_ord_ven_idn
			strval($ord_ven_idn),				// @ord_ven_idn
			$pro->pro_idn, 						// @pro_idn
			$pc->cantidad,						// @det_ord_ven_cantidad
			$dcto,								// @det_ord_ven_descuento
			$valor * $pc->cantidad,				// @det_ord_ven_valor
			'148',								// @fun_idn (funcionario web)
			0,									// @det_ord_ven_can_pen           ?????????
			$user->cat_idn,						// @det_ord_ven_lista
			0,									// @det_tipo_proseso
			'99.999.999-9', 					// @fun_rut_aut
			$user->por_uti_idn, 				// @por_uti_idn
			$valor_con_iva, 					// @det_ord_ven_total
			$valor - ($valor_con_iva - $valor) + $pro->pro_costo,	// @det_ord_ven_valor_comi
			$pro->pro_codigo,					// @pro_codigo codigo producto
			$pro->pro_aux, 						// @pro_aux
			$pro->pro_nombre,					// @pro_nombre
			$pro->pro_stock,					// @stock_anterior
		];

		DB::update('exec dbo.detalle_orden_de_venta_agrega ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $parametros);

		DB::table('CORRELATIVOS')
		->where('corre_tipo', '45')
		->update(['corre_correlativo' => strval($det_ord_ven_idn)]);

		$det_ord_ven_idn = $det_ord_ven_idn + 1;
		dd($det_ord_ven_idn);
	}

	echo "Id Factura: ". $ord_ven_idn;
	echo " || Id Detalle: ". $det_ord_ven_idn;
	return 1;

});


Route::get('aaa', function() {
	$users = DB::table('DEPENDENCIAS_DEL_CLIENTE')
	->take(55)
	->get();
	dd($users);
});