<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Carrito;
use App\Producto;
use App\Region;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


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


		$regiones = Region::orderByRaw('CAST(div_pol_idn AS INT) asc')->get();

		$regiones->jsonSerialize();
		$regiones->toJson();

		return view('cliente.create_account')
		->with('categorias', $categorias)
		->with('regiones', $regiones);
	}

	public function storeCreateAccount(Request $request)
	{				
		$data = array('status' => true, 'errors' => null, 'existe' => null);
		//dd($request->input());
		//Validación

		$rut = User::convertirRut($request->rut);
		$dependencias = User::getDependencias($rut);
		
		$cant_dep = count($dependencias);
		
		if($cant_dep == 0) {

		} else if($cant_dep == 1) {
			
		} else {
			if(count($user) > 1) {
				$reglas['dependencias']         = "required";
				$msjs['dependencias.required']  = "La sucursal es obligatoria";
			} else {
				$request->merge(['dependencias' => $user->first()->dep_cli_idn]);
			}
		}

		$rut = $request->input('rut');
		$reglas['rut'] = "required";
		$msjs['rut.required'] = "El rut es obligatorio";

		$reglas['nombre'] = "required";
		$msjs['nombre.required'] = "El nombre es obligatorio.";

		$reglas['apellidos'] = "required";
		$msjs['apellidos.required'] = "Los apellidos son obligatorios.";

		$reglas['email'] = "required";
		$msjs['email.required'] = "El E-mail es obligatorio.";

		$reglas['id_region'] = "required";
		$msjs['id_region.required'] = "La Región es obligatoria.";

		$reglas['id_ciudad'] = "required";
		$msjs['id_ciudad.required'] = "La Ciudad es obligatoria.";

		$reglas['numero'] = "required|digits_between:1,10";
		$msjs['numero.required'] 	= "El número es obligatorio.";
		$msjs['numero.digits_between'] 		= "El máximo es de 10 dígitos.";

		$reglas['direccion'] = "required|max:132";
		$msjs['direccion.required'] = "La dirección es obligatoria.";
		$msjs['direccion.max'] 		= "El máximo es de 132 caracteres.";

		$reglas['telefono'] = "required|digits:8";
		$msjs['telefono.required'] = "El Teléfono es obligatorio.";
		$msjs['telefono.digits'] = "El teléfono debe contener sólo 8 números.";

		$reglas['pw'] = 'required|confirmed|min:6';
		$msjs['pw.required'] = "La contraseña es obligatoria.";
		$msjs['pw.confirmed'] = "Las contraseñas no coinciden.";
		$msjs['pw.min'] = "La contraseña debe tener mas de 5 caracteres";

		if($cant_dep > 0) {
			
		}

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
				// $id_cliente = DB::table('CORRELATIVOS')
				// ->where('corre_idn', 1042)->first()->corre_correlativo + 1;

				//dd($id_cliente); 1217
				//$id_dep_del_cli = DB::table('CORRELATIVOS')
				//->where('corre_idn', 1043)->first()->corre_correlativo + 1;

				DB::table('CLIENTE')->insert(
					['cli_idn' 			=>  strtoupper(str_replace('.', '', $request->rut)), //strval($id_cliente),
					'cli_rut' 			=> strtoupper($request->rut),
					'cli_razon_social' 	=> strtoupper($request->nombre).' '.strtoupper($request->apellidos),
					'tipo' 			=> "PARTICULAR",
					'cli_traslado' 		=> 0]
				);

				DB::table('DEPENDENCIAS_DEL_CLIENTE')->insert(
					['dep_cli_idn' 		=> strval($id_dep_del_cli),
					'cli_idn' 			=> strtoupper(str_replace('.', '', $request->rut)),
					'dep_cli_nombre' 	=> strtoupper($request->nombre).' '.strtoupper($request->apellidos),
					'cli_giro' 			=> "PARTICULAR",
					//'dep_cli_direccion' => " ",
					'seg_div_pol_idn' => $request->id_ciudad,
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

				DB::table('web_despacho')->insert(
					['dep_cli_idn' 		=> strval($id_dep_del_cli),
					'seg_div_pol_idn' 	=> $request->id_ciudad,
					'direccion' 		=> $request->direccion,
					'numero'			=> $request->numero,
					'telefono'			=> $request->telefono
				]
			);

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

}



