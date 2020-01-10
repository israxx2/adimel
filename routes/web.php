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


Route::get('/', 'Cliente\GeneralController@inicio')->name('cliente.inicio');

Route::get('/mercadoPublico', 'Cliente\GeneralController@mercadoPublico');

Route::get('/quienes-somos', 'Cliente\GeneralController@quienesSomos');

Route::get('/contacto', 'Cliente\GeneralController@viewContacto');

Route::get('/cart', 'Cliente\GeneralController@cart');

Route::get('/checkout', 'Cliente\GeneralController@checkout');

Route::get('/viewProduct/{id}', 'Cliente\GeneralController@viewProduct');

Route::get('/categoria/{id}', 'Cliente\GeneralController@categoria');

Route::get('/nueva-cuenta', 'Cliente\GeneralController@viewCreateAccount')->name('cliente.create_account');
Route::post('/nueva-cuenta', 'Cliente\GeneralController@storeCreateAccount')->name('cliente.create_account.store');



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
	$users = DB::table('DEPENDENCIAS_DEL_CLIENTE')
	->select([DB::raw('MAX(CAST(dep_cli_idn AS int)) AS dep_cli_idn')])->first()->dep_cli_idn;
	dd($users + 1);


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
