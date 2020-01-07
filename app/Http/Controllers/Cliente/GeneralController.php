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

	public function createAccount()
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

	public function contacto() {
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
