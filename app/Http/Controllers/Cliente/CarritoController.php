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
		
		dd($request->tipo);
		return response()->json(true);

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

