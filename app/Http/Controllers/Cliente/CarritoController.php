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
		//6347
		
		//dd(Carrito::orderBy('dep_cli_idn', 'ASC')->get());
		$dep_cli_idn = $user->dep_cli_idn;
		//dd($dep_cli_idn);
		$prods = Carrito::where('dep_cli_idn', $dep_cli_idn)->get();

		dd($prods);
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

		if($request->tipo = 'nueva') {
			DB::table('web_despacho')->insert(
				['dep_cli_idn' 		=> $user->id_dep_del_cli,
				'seg_div_pol_idn' 	=> $request->id_ciudad,
				'direccion' 		=> $request->direccion,
				'numero'			=> $request->numero,
				'telefono'			=> $request->telefono
			]);
		} else if($request->tipo = 'actual') {


			DB::beginTransaction();
			try {

				/*
				* Ingresar Orden de Venta
				*
				* Aca se inicializan las variables para ingresar una nueva orden de venta,
				* la cual necesita en escencia al cliente, vendedor y tipo de vendedor, 
				* iva y total de la venta.
				*/
				$correlativo = DB::table('CORRELATIVOS')->where('corre_tipo', '29')->first();
				$ord_ven_idn = $correlativo->corre_correlativo + 1;

				$iva = DB::table('IVA')->where('iva_activo', '1')->first();
				$valor_iva = $iva->IVA;
				$iva_idn = $iva->iva_idn;

				$dep_cli_idn = $user->id_dep_del_cli;

				$ven_idn = 'WW';

				$tip_ven_idn = '1'; //5

				$rec_idn = '1';

				$ord_ven_neto = 10000; //Total de la venta

				$ord_ven_iva = ($ord_ven_neto * $valor_iva); //Total venta + iva

				$ord_ven_num_ordcom = '0';

				$tipo = '1';

				$parametros = [
					$ord_ven_idn,			// @ord_ven_idn
					'99.999.999-9',			// @fun_rut
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
				$ins = DB::update('exec dbo.orden_de_venta_asigna ?,?,?,?,?,?,?,?,?,?,?', $parametros);

				DB::table('CORRELATIVOS')
				->where('corre_tipo', '29')
				->update(['corre_correlativo', $ord_ven_idn]);

				/*
				* Ingresar Detalle Orden de Venta
				*
				* Se ingresa el detalle de la orden de venta, en donde por cada producto se debe ingresar
				* un detalle, es por eso que va dentro de un foreach.
				*/
				
				//Se buscan los productos en el carrito y dps en la tabla producto
				$prod = App\Carrito::where('dep_cli_idn', $dep_cli_idn)->get();
				$ids = [];
				foreach($prod as $p) {
					$ids[] = $p->prod_codigo;
				}

				$productos = DB::table('PRODUCTOS')
				->whereIn('pro_codigo', $ids)
				->get();

				foreach($productos as $pro) {

					$parametros = [
						strval($det_ord_ven_idn),   		// @det_ord_ven_idn
						strval($ord_ven_idn),				// @ord_ven_idn
						$pro_idn, 							// @pro_idn
						$cantidad,							// @det_ord_ven_cantidad
						$dcto,								// @det_ord_ven_descuento
						$precio,							// @det_ord_ven_valor
						'148',								// @fun_idn (funcionario web)
						0,									// @det_ord_ven_can_pen           ?????????
						$user->cat_idn,						// @det_ord_ven_lista
						0,									// @det_tipo_proseso
						'99.999.999-9', 					// @fun_rut_aut
						'1', 								// @por_uti_idn
						$total, 							// @det_ord_ven_total
						$total - ($costo_producto + $iva),	// @det_ord_ven_valor_comi
						$pro->pro_codigo,					// @pro_codigo codigo producto
						$pro->pro_aux, 						// @pro_aux
						$pro->pro_nombre,					// @pro_nombre
						$pro->pro_stock,					// @stock_anterior
					];
					DB::update('exec dbo.detalle_orden_de_venta_agrega ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
				}

			} catch (\Exception $e) {
				$data['status'] = FALSE;
				$data['data'] = 'Error al insertar nuevo despacho';
				DB::rollBack();
				return response()->json($data);
			}

			DB::commit();

			return response()->json($data);

		}


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

