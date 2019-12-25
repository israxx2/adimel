<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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