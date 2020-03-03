<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Carrito;
use App\Producto;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{

	public function getCarrito() {

		$carrito2=Auth::guard('cliente')->user()->carrito;
		$carrito2=modificarCarrito($carrito2);
		return response()->json($carrito2);

	}

	public function addCarrito(Request $request) {

		//dd(	DB::table('web_carrito')->get());
		$Producto = Producto::where([['pro_codigo', $request->producto]])->first();


		$item = Carrito::where([
			['dep_cli_idn', Auth::guard('cliente')->id()],
			['prod_codigo', $request->producto]]
		)->first();
		
		if($item){

			$item->cantidad=$item->cantidad+$request->cantidad;
			$item->update();
		}
		else{

			$carrito= new Carrito();
			$carrito->dep_cli_idn= Auth::guard('cliente')->id();
			$carrito->prod_codigo= $request->producto;
			$carrito->prod_nombre= $Producto->pro_nombre;
			$carrito->cantidad= $request->cantidad;
			$carrito->save();
			
		}

		$carrito2=Auth::guard('cliente')->user()->carrito;
		$carrito2=modificarCarrito($carrito2);

		return response()->json($carrito2);

	}
	
	public function deleteCarrito(Request $request) {

		//::truncate();
		$carrito=Carrito::where(
			[
				['dep_cli_idn',Auth::guard('cliente')->id()],
				['prod_codigo',$request->producto],
			]
		)->delete();

		$carrito2=Auth::guard('cliente')->user()->carrito;
		$carrito2=modificarCarrito($carrito2);
		return response()->json($carrito2);

	}

	public function editCarrito(Request $request) {
		
		$item = Carrito::where([
			['dep_cli_idn', Auth::guard('cliente')->id()],
			['prod_codigo', $request->producto]]
		)->first();
		

		$item->cantidad=$request->cantidad;
		$item->update();

		$carrito2=Auth::guard('cliente')->user()->carrito;
		$carrito2=modificarCarrito($carrito2);

		return response()->json($carrito2);

	}

	public function efectuarcompra(Request $request) {

		$data = array('estado' => TRUE, 'error' => FALSE, 'data' => null);
		$user = Auth::guard('cliente')->user();

		//$request->tipo -> nueva: cliente sin direccion
		//					crear:  cliente crear nueva direccion de envio
		//					actual: cliente elige la direccion actual.
		



		//si es actual entonces -> $request->id_direccion para saber a cual enviar.
		//$user->despachos();


		//si es nueva entonces añadir a su unica dependencia que tiene->
				// $request->tipo
				// $request->direccion
				// $request-> ciudad
				// $request->comuna
				// $request->telefono
		
		DB::beginTransaction();
		try {
			DB::table('web_despacho')->insert(
				['dep_cli_idn' 		=> $user->id_dep_del_cli,
				'seg_div_pol_idn' 	=> $request->id_ciudad,
				'direccion' 		=> $request->direccion,
				'numero'			=> $request->numero,
				'telefono'			=> $request->telefono
			]);
		} catch (\Exception $e) {
			$data['status'] = FALSE;
			$data['data'] = 'Error al insertar nuevo despacho';
			DB::rollBack();
			return response()->json($data);
		}
		DB::commit();
		//si es crear entonces generar nueva dep->
				// $request->tipo
				// $request->direccion
				// $request-> ciudad
				// $request->comuna
				// $request->telefono


		//$request->comentario   -> comentario de la compra.


		return response()->json($data);

	}
	

}



function modificarCarrito($carrito2){
	foreach($carrito2 as $item) {
		if($item->producto->isOffer()->des_pro_estado==null){
			$item->precio= $item->producto->pro_valor_venta1;
		}
		else{
			$item->precio= $item->producto->isOffer()->des_pro_precio;
		}
		
	}
	return $carrito2;
}

