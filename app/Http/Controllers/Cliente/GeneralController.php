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
	
		$productos= Producto::where([
			['pro_stock', '>', 0],
		])->paginate(16);
			
		//3545 tiene oferta
		
		$productos=ToCLP($productos);
		
		
		$offer1=Producto::where([
			['pro_stock', '>', 0]
		])->first();
		

		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();
		
		return view('cliente.home')
		->with('categorias', $categorias)
		->with('offer1', $offer1)
		->with('productos', $productos);
	}

	public function mercadoPublico() {
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();
		return view('cliente.mercadoPublico')
		->with('categorias', $categorias);
	}

	public function quienesSomos() {
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		return view('cliente.about')
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
		$productos= Producto::where([
			['pro_codigo', $id],
			['pro_stock', '>', 0]
		])->get();
		$productos=ToCLP($productos)->first();
		

		$similaryProducts = Producto::where([
			['pro_stock', '>', 0],
			['rub_idn', '=', $productos->rub_idn],
			['pro_codigo', '!=',$id],
		])->take(5)->get();
		$similaryProducts=ToCLP($similaryProducts);

		
		$categorias = DB::table('RUBRO')
		->where([
			['rub_estado', 1],
			['rub_idn', '!=', 0],
			['rub_idn', '!=', 8],
		])->get();

		return view('cliente.detailsProduct')
		->with('categorias', $categorias)
		->with('productos', $productos)
		->with('similaryProducts', $similaryProducts);
	}

	public function categoria($id, Request $request) {
		$buscar=$request->s;
		
		$productos= Producto::where([
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


}



function ToCLP($productos){
	// |
	return $productos;
}



