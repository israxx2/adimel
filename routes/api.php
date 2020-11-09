<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Region;
use App\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

/*
*	Productos
*/
Route::get('productos/datatable', function (Request $request){

	if($request->ajax())
	{
		$productos = DB::table('PRODUCTOS')
		->where('pro_stock', '>', 0)
		->get();
		return Datatables()->collection($productos)->make(true);
	} else return [];
})->name('api.proveedor.datatable');

Route::get('ciudades/{id_region}', function($id, Request $request) {

	$row = [
		'seg_div_pol_idn' 		=> null, 
		'seg_div_pol_nombre' 	=> null, 
		'div_pol_idn' 			=> null, 
		'seg_div_cod_area' 		=> null
	];

	$data = ['ciudades' => array()];

	$ciudades = Region::find($id)->ciudades->sortBy('seg_div_pol_nombre');

	$row = [];
	foreach($ciudades as $c) {
		$row['seg_div_pol_idn'] 	= $c->seg_div_pol_idn;
		$row['seg_div_pol_nombre'] 	= ucwords(strtolower(htmlentities($c->seg_div_pol_nombre)));
		$row['div_pol_idn'] 		= $c->div_pol_idn;
		$row['seg_div_cod_area'] 	= $c->seg_div_cod_area;		
		array_push($data['ciudades'], $row);
	}
	// dd($data['ciudades']);
	return response()->json($data['ciudades']);
})->name('api.ciudades');

Route::post('get_dependencias', function(Request $request) {
	$data = ['dependencias' => array(), 'status' => TRUE, 'error' => null, 'count' => null, 'count_web' => null];
	if($request->ajax()) {
		$rut = User::convertirRut($request->rut);
		$creados = 0;
		if($dependencias = User::getDependencias($rut)) {
			foreach($dependencias as $dep) {
				if(is_null($dep->password)) {
					$aux = array();
					$aux['idn'] 		= $dep->dep_cli_idn;
					$aux['cli_idn'] 	= $dep->cli_idn;
					$aux['giro'] 		= $dep->cli_giro;
					$aux['ciudad'] 		= $dep->dep_cli_ciudad;
					$aux['email'] 		= $dep->dep_cli_email;
					$aux['nombre'] 		= ucwords(strtolower(htmlentities($dep->dep_cli_nombre)));
					$aux['web'] 		= $dep->dep_cli_web;
					$data['dependencias'][]	= $aux;
				} else {
					$creados++;
				}
			}
			$data['count_web'] = $creados;
			$data['count'] = count($dependencias);
			
		} else {
			$data['status'] = FALSE;
		}
	}
	return response()->json($data);
})->name('api.get_dependencias');

Route::post('get_dependencias_web', function(Request $request) {
	$data = ['dependencias' => array(), 'status' => TRUE, 'error' => null, 'count' => null, 'count_web' => null];
	if($request->ajax()) {
		$rut = User::convertirRut($request->rut);
		
		if($dependencias = User::getDependencias($rut)) {
			foreach($dependencias as $dep) {
				if(!is_null($dep->password)) {
					$aux = array();
					$aux['idn'] 		= $dep->dep_cli_idn;
					$aux['cli_idn'] 	= $dep->cli_idn;
					$aux['giro'] 		= $dep->cli_giro;
					$aux['ciudad'] 		= $dep->dep_cli_ciudad;
					$aux['email'] 		= $dep->dep_cli_email;
					$aux['nombre'] 		= ucwords(strtolower(htmlentities($dep->dep_cli_nombre)));
					$aux['web'] 		= $dep->dep_cli_web;
					$data['dependencias'][]	= $aux;
				}

			}
			$data['count_web'] 	= count($data['dependencias']);
			$data['count'] 		= count($dependencias);
			
		} else {
			$data['status'] = FALSE;
		}
	}
	return response()->json($data);
})->name('api.get_dependencias_web');