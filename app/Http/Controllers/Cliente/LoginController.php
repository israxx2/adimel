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
use Illuminate\Support\Str;
use App\Mail\RecuperarContrasena;
use Illuminate\Support\Facades\Mail;


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
		$data = array('status' => true, 'errors' => null, 'existe' => false, 'count' => null);
		$rut = User::convertirRut($request->rut);

		//Busca las dependencias del usuario
		$dependencias = User::getDependencias($rut);

		$count = count($dependencias);
		$count_web = 0;
		$data['count'] = $count;

		foreach($dependencias as $dep) {
			if(!is_null($dep->password)) $count_web++;
		}

		/**************************************
		*			VALIDACIÓN
		**************************************/
		$rut = $request->input('rut');
		$reglas['rut'] = "required";
		$msjs['rut.required'] = "El rut es obligatorio";

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

		//Si tiene mas de una el cliente debe seleccionar cuál desea usar
		if($count > 0 && ($count - $count_web) > 0) {
			$reglas['dependencias']         = "required";
			$msjs['dependencias.required']  = "La sucursal es obligatoria";
		} else {
			$reglas['nombre'] = "required";
			$msjs['nombre.required'] = "El nombre es obligatorio.";
			$reglas['apellidos'] = "required";
			$msjs['apellidos.required'] = "Los apellidos son obligatorios.";
		}

		$validator = \Validator::make($request->all(), $reglas, $msjs);
		if ($validator->fails())
		{
			$data['errors'] = response()->json(['errors'=>$validator->errors()]);
			return $data;
		}

		/**************************************
		*			INGRESAR CLIENTE
		**************************************/

		//Si el usuario no tiene dependencias se crea la dependencia
		if($count == 0) {

			$cliente = new User();

			//Si el usuario no existe se crea
			if(!User::existe($rut)){
				$cliente->dep_cli_nombre	= $request->nombre.' '.$request->apellidos;
				$cliente->cli_rut 			= $request->rut;
				$cliente->saveCliente();
			} else {
				//Retorna atributos de relación tabla CLIENTE
				$cliente->getCliente($rut);
			}
			$cliente->dep_cli_direccion	= $request->direccion;
			$cliente->seg_div_pol_idn	= $request->id_ciudad;
			$cliente->dep_cli_fono		= $request->telefono;
			$cliente->cat_idn			= '99';
			$cliente->zon_idn			= '100';
			$cliente->dep_cli_descuento = "0";
			$cliente->ven_idn 			= "N";
			$cliente->dep_cli_estado	= '1';
			$cliente->dep_cli_email		= $request->email;
			$cliente->dep_cli_web		= '1';
			$cliente->por_uti_idn		= '1';
			$cliente->pla_pag_idn		= '100';
			$cliente->for_pag_idn		= '1';
			$cliente->password			= bcrypt($request->pw);
			
			$cliente->saveDependenciasDelCliente();
		}

		//Si tiene 1 dependencia se le asigna a esta misma la cuenta
		else if($count - $count_web > 0) {
			$cliente = User::find($request->dependencias);
			
			$cliente->password 			= bcrypt($request->pw);
			$cliente->dep_cli_direccion	= $request->direccion;
			$cliente->dep_cli_email		= strtoupper($request->email);
			$cliente->seg_div_pol_idn	= $request->id_ciudad;
			$cliente->dep_cli_fono		= $request->telefono;
			$cliente->dep_cli_web 		= "1";

			$cliente->save();
		} else {
			$data['existe'] = true;
			$cliente = "todas sus dependencias tienen clave";
		}

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

	public function recuperarClave(Request $request) {
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		$rut = $request->input('login_rut_r');
		$dep = $request->input('dependencias');
		$user = null;
		if($dep){
			$user = User::find($dep);
		}else{
			$user = User::getDependencias($rut)[0];
			$user = User::find($user->dep_cli_idn);
		}

		if($user){
			$token = Str::random(60);


			$current_date = date('Y-d-m H:i:s');

			$user->dep_token_web = $token;
			$user->dep_fecha_token_web = $current_date;

			$user->save();
			//Mail::to($user->dep_cli_email)->send(new RecuperarContrasena($user));
			Mail::to(["carlosmof15@gmail.com"])->send(new RecuperarContrasena($user));

			return view('cliente.recuperar')->with('categorias', $categorias);

		}
	}

	public function recuperarClave2($id, $token) {
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		return view('cliente.recuperar_contrasena')
		->with('categorias', $categorias)
		->with('id', $id)
		->with('token', $token);
	}

	public function recuperarClave3(Request $request) {
		$data = ['status' => TRUE, 'errors' => null, 'expired' => FALSE];
		
		$current_token = $request->input('mail_token');
		$user_id = $request->input('user_id');
		$user = User::find($user_id);
		
		$user_token =  $user->dep_token_web;
		$user_expiration_date = $user->dep_fecha_token_web;


		$now = date('Y-m-d H:i:s');
		$new_time =  date('Y-m-d H:i:s',strtotime('+2 hours',strtotime($user_expiration_date)));

		if($now > $new_time || $user_token != $current_token ){
			$data['expired'] = TRUE;
			return $data;
		}


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

		$user->password =  bcrypt($request->input('pw'));
		$user->dep_token_web=  null;
		$user->save();
		//dd($user);



		$data['status'] = TRUE;

		return $data;
	}
}



