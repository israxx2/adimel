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

class GeneralController extends Controller
{


	public function inicio()
	{
		$productos= DB::table('PRODUCTOS')
		->where('pro_stock', '>', 0)
		->paginate(16);
		
		$productos=ToCLP($productos);
		
		
		$offer1=DB::table('PRODUCTOS')
		->where('pro_stock', '>', 0)
		->get()->first();
		

		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();
		
		return view('cliente.index')
		->with('categorias', $categorias)
		->with('offer1', $offer1)
		->with('productos', $productos);
	}

	public function clienteLogout(request $request) {
		Auth::guard('cliente')->logout();
		$request->session()->invalidate();
		return redirect('/');
	}

	public function viewCreateAccount()
	{
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();
		return view('cliente.create_account')
		->with('categorias', $categorias);
	}

	public function storeCreateAccount(Request $request)
	{		
		$data = array('status' => true, 'errors' => null, 'existe' => null);
		//dd($request->input());
		//Validación
		$rut = $request->input('rut');
		$reglas['rut'] = "required";
		$msjs['rut.required'] = "El rut es obligatorio";

		$reglas['nombre'] = "required";
		$msjs['nombre.required'] = "El nombre es obligatorio.";

		$reglas['apellidos'] = "required";
		$msjs['apellidos.required'] = "Los apellidos son obligatorios.";

		$reglas['email'] = "required";
		$msjs['email.required'] = "El E-mail es obligatorio.";

		$reglas['pw'] = 'required|confirmed|min:6';
		$msjs['pw.required'] = "La contraseña es obligatoria.";
		$msjs['pw.confirmed'] = "Las contraseñas no coinciden.";
		$msjs['pw.min'] = "La contraseña debe tener mas de 5 caracteres";

		$validator = \Validator::make($request->all(), $reglas, $msjs);
		if ($validator->fails())
		{
			$data['errors'] = response()->json(['errors'=>$validator->errors()]);
			return $data;
		}

        //Se busca al cliente x si existe
		$cliente = DB::table('CLIENTE')
		->where('cli_rut', $request->rut)->first();

		
		DB::beginTransaction();
		try {
			//SI EL CLIENTE YA EXISTE....
			if($cliente) {
				$user = DB::table('DEPENDENCIAS_DEL_CLIENTE')
				->where('cli_idn', $cliente->cli_idn)->first();

				//YA TIENE CONTRASEÑA.....
				if($user->password) {
					$data['existe'] = 'El usuario con ese rut ya posee una cuenta.';
				} else {
					$user = DB::table('DEPENDENCIAS_DEL_CLIENTE')
					->where('cli_idn', $cliente->cli_idn)
					->update(['password' => bcrypt($request->pw)]);
					$data['existe'] = 'Se ha asignado una contraseña con exito.';
				}
			//SI NO EXISTE....
			} else {
				$id_cliente = DB::table('CORRELATIVOS')
				->where('corre_idn', 1042)->first()->corre_correlativo + 1;

				//dd($id_cliente); 1217
				$id_dep_del_cli = DB::table('CORRELATIVOS')
				->where('corre_idn', 1043)->first()->corre_correlativo + 1;

				DB::table('CLIENTE')->insert(
					['cli_idn' 			=> strval($id_cliente), //strtoupper(str_replace('.', '', $request->rut))
					'cli_rut' 			=> strtoupper($request->rut),
					'cli_razon_social' 	=> strtoupper($request->nombre).' '.strtoupper($request->apellidos),
					'cli_giro' 			=> "PARTICULAR",
					'cli_traslado' 		=> 0]
				);

				DB::table('DEPENDENCIAS_DEL_CLIENTE')->insert(
					['dep_cli_idn' 		=> strval($id_dep_del_cli),
					'cli_idn' 			=> strtoupper(str_replace('.', '', $request->rut)),
					'dep_cli_nombre' 	=> strtoupper($request->nombre).' '.strtoupper($request->apellidos),
					'cli_giro' 			=> "PARTICULAR",
					//'dep_cli_direccion' => " ",
					'seg_div_pol_idn' => "000",
					//'dep_cli_fono' => " ",
					//'dep_cli_fax' => " ",
					//'dep_cli_casilla' => " ",
					//'dep_cli_enc_atencion' => " ",
					'cat_idn' => "99", 
					'zon_idn' => "100",
					'dep_cli_descuento' => "0",
					'ven_idn' => "N",
					'dep_cli_email' => strtoupper($request->email),
					'dep_cli_web' => "1",
					'por_uti_idn' => "1",
					'dep_cli_estado' => "1",
					//'dep_cli_monaut' => " ",
					'pla_pag_idn' => "100",
					'for_pag_idn' => "1",
					//1'dep_cli_saldo_favor' => " ",
					//'dep_cli_ciudad' => " ",
					//'dep_plazo_pago' => " ",
					//'dep_cli_usuario_web' => " ",
					'password' => bcrypt($request->pw)
				]);

				DB::table('CORRELATIVOS')
				->where('corre_idn', 1042)
				->update(['corre_correlativo' => $id_cliente]);

				$b = DB::table('CORRELATIVOS')
				->where('corre_idn', 1043)
				->update(['corre_correlativo' => $id_dep_del_cli]);
				//CORRELATIVO ID DEPENDENCIAS_DEL_CLIENTE,,, corre_correlativo
				//detalle_orden_de_venta_agrega
				//atributo tipo en cliente
				//orden de venta
				//dd("todo ok");
			}
			
		} catch (\Exception $e) {
			$data['status'] = false;
			DB::rollBack();
			return $data;
		}
		DB::commit();

		return $data;
	}

	public function mercadoPublico() {
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();
		return view('cliente.mercado-publico')
		->with('categorias', $categorias);
	}

	public function quienesSomos() {
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		return view('cliente.about_us')
		->with('categorias', $categorias);
	}

	public function viewContacto() {
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		return view('cliente.contact')
		->with('categorias', $categorias);
	}

	public function cart() {
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		return view('cliente.cart')
		->with('categorias', $categorias);
	}

	public function checkout() {
		$user = DB::table('DEPENDENCIAS_DEL_CLIENTE')
	->where('dep_cli_idn',1 /*Auth::guard('cliente')->id()*/)->first();
	

	$categorias = DB::table('RUBRO')
	->where([
		['rub_estado', 1],
		['rub_idn', '!=', 0],
		['rub_idn', '!=', 8],
	])->get();

	return view('cliente.checkout')
	->with('user', $user)
	->with('categorias', $categorias);
}

public function viewProduct($id) {
		//0000003070147
	$productos= DB::table('PRODUCTOS')
	->where([
		['pro_idn', $id],
		['pro_stock', '>', 0]
	])->get();
	$productos=ToCLP($productos)->first();
	

	$similaryProducts = DB::table('PRODUCTOS')
	->where([
		['pro_stock', '>', 0],
		['rub_idn', '=', $productos->rub_idn],
		['pro_idn', '!=',$id],
	])->take(5)->get();
	$similaryProducts=ToCLP($similaryProducts);

	
	$categorias = DB::table('RUBRO')
	->where([
		['rub_estado', 1],
		['rub_idn', '!=', 0],
		['rub_idn', '!=', 8],
	])->get();

	return view('cliente.single-product')
	->with('categorias', $categorias)
	->with('productos', $productos)
	->with('similaryProducts', $similaryProducts);
}

public function categoria($id, Request $request) {
	$buscar=$request->s;
	
	$productos= DB::table('PRODUCTOS')
	->where([
		['rub_idn', $id],
		['pro_stock', '>', 0],
		['pro_nombre','like', '%'.$buscar.'%'],
	])->paginate(8);
	$productos=ToCLP($productos);

	$categorias = DB::table('RUBRO')
	->where([
		['rub_estado', 1],
		['rub_idn', '!=', 0],
		['rub_idn', '!=', 8],
	])->get();

	$cat = DB::table('RUBRO')
	->where([
		['rub_idn', $id],
	])->first();

	return view('cliente.filterProducts')
	->with('categorias', $categorias)
	->with('cat', $cat)
	->with('productos', $productos);
}

	/**
	* Comprueba si el rut ingresado es valido
	* @param string $rut RUT
	* @return boolean
	*/
	public function valida_rut($rut)
	{
		if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
			return false;
		}
		$rut = preg_replace('/[\.\-]/i', '', $rut);
		$dv = substr($rut, -1);
		$numero = substr($rut, 0, strlen($rut) - 1);
		$i = 2;
		$suma = 0;
		foreach (array_reverse(str_split($numero)) as $v) {
			if ($i == 8)
				$i = 2;
			$suma += $v * $i;
			++$i;
		}
		$dvr = 11 - ($suma % 11);
		if ($dvr == 11)
			$dvr = 0;
		if ($dvr == 10)
			$dvr = 'K';
		if ($dvr == strtoupper($dv))
			return true;
		else
			return false;
	}


	public function getCarrito() {
	
		$carrito2=Auth::guard('cliente')->user()->carrito;
		foreach($carrito2 as $item) {
			$item->precio= $item->producto->pro_valor_venta1;
		}
		return response()->json($carrito2);

	}

	public function addCarrito(Request $request) {

		//dd(	DB::table('web_carrito')->get());
		$Producto = DB::table('PRODUCTOS')
		->where([['pro_codigo', $request->producto]])->first();

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
			//$carrito->precio= $Producto->pro_valor_venta1;
			$carrito->cantidad= $request->cantidad;
			$carrito->save();
			
		}
		$carrito2=Auth::guard('cliente')->user()->carrito;
		foreach($carrito2 as $item) {
			$item->precio= $item->producto->pro_valor_venta1;
		}
	
	
		return response()->json($carrito2);
		

	}
	
	public function deleteCarrito(Request $request) {

	
		$carrito=Carrito::where(
			[
				['dep_cli_idn',Auth::guard('cliente')->id()],
				['prod_codigo',$request->producto],
			]
		)->delete();

		$carrito2=Auth::guard('cliente')->user()->carrito;
		foreach($carrito2 as $item) {
			$item->precio= $item->producto->pro_valor_venta1;
		}
	
	
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
		foreach($carrito2 as $item) {
			$item->precio= $item->producto->pro_valor_venta1;
		}
	
	
		return response()->json($carrito2);

	}


}



function ToCLP($productos){
	// |
	return $productos;
}


