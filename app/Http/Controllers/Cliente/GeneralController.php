<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class GeneralController extends Controller
{
	public function inicio()
	{
		$productos= DB::table('PRODUCTOS')
		->where('pro_stock', '>', 0)
		->paginate(16);

		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		return view('cliente.index-3')
		->with('categorias', $categorias)
		->with('productos', $productos);
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
		$data = array('status' => true, 'errors' => null);
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

        //Ingreso datos
        try {


        } catch (\Exception $e) {
        //si falla retornar error
        }

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
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		return view('cliente.checkout')
		->with('categorias', $categorias);
	}

	public function viewProduct($id) {
		//0000003070147
		$productos= DB::table('PRODUCTOS')
		->where([
			['pro_idn', $id],
			['pro_stock', '>', 0]
		])->get();

		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		return view('cliente.single-product')
		->with('categorias', $categorias)
		->with('productos', $productos);
	}

	public function categoria($id) {
		$productos= DB::table('PRODUCTOS')
		->where([
			['rub_idn', $id]
		])->paginate(8);

		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		$cat = DB::table('RUBRO')
		->where([
			['rub_idn', $id],
		])->get();


		return view('cliente.filterProducts')
		->with('categorias', $categorias)
		->with('cat', $cat->first())
		->with('productos', $productos);
	}

}
