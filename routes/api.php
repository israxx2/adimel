<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Region;
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

	$ciudades = Region::find($id)->ciudades;

	foreach($ciudades as $c) {
		$row['seg_div_pol_idn'] 	= $c->seg_div_pol_idn;
		$row['seg_div_pol_nombre'] = $c->seg_div_pol_nombre;
		$row['div_pol_idn'] 		= $c->div_pol_idn;
		$row['seg_div_cod_area'] 	= $c->seg_div_cod_area;
		$data['ciudades'] = $row;
	}
	return $data;
})->name('api.ciudades');