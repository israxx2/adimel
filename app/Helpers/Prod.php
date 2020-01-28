<?php 
namespace App\Helpers;
use App\Producto;
use Illuminate\Support\Facades\DB;

class Prod {

	public static function get($id)
	{
		return Producto::find($id);
	}
	
	//Si el campo DESCUENTO_PRODUCTO.des_pro_estado es null la oferta está inactiva
	//Entrada opcional: fam_idn para filtrar por familia
	//Retorna los productos relacionado con las ofertas.
	public static function all($categoria = null) {
		$prod = null;

		if($categoria != null) {
			$prod = DB::table('PRODUCTOS')
			->select('PRODUCTOS.pro_codigo', 'PRODUCTOS.pro_idn', 'PRODUCTOS.pro_nombre', 'PRODUCTOS.pro_stock', 'PRODUCTOS.pro_stock_minimo', 'PRODUCTOS.pro_stock_maximo', 'PRODUCTOS.pro_valor_venta1', 'DESCUENTO_PRODUCTO.des_pro_precio', 'DESCUENTO_PRODUCTO.des_pro_estado', 'DESCUENTO_PRODUCTO.des_pro_fecha_inicio', 'DESCUENTO_PRODUCTO.des_pro_fecha_termino', 'DESCUENTO_PRODUCTO.des_pro_stock')
			->leftJoin('DESCUENTO_PRODUCTO', 'PRODUCTOS.pro_codigo', '=', 'DESCUENTO_PRODUCTO.pro_codigo')
			->where('PRODUCTOS.fam_idn', $categoria)
			->where('DESCUENTO_PRODUCTO.des_pro_estado', null)
			->orWhere('DESCUENTO_PRODUCTO.des_pro_estado', 1)
			->take('500')
			->get();
		} else {
			$prod = DB::table('PRODUCTOS')
			->select('PRODUCTOS.pro_codigo', 'PRODUCTOS.pro_idn', 'PRODUCTOS.pro_nombre', 'PRODUCTOS.pro_stock', 'PRODUCTOS.pro_stock_minimo', 'PRODUCTOS.pro_stock_maximo', 'PRODUCTOS.pro_valor_venta1', 'DESCUENTO_PRODUCTO.des_pro_precio', 'DESCUENTO_PRODUCTO.des_pro_estado', 'DESCUENTO_PRODUCTO.des_pro_fecha_inicio', 'DESCUENTO_PRODUCTO.des_pro_fecha_termino', 'DESCUENTO_PRODUCTO.des_pro_stock')
			->leftJoin('DESCUENTO_PRODUCTO', 'PRODUCTOS.pro_codigo', '=', 'DESCUENTO_PRODUCTO.pro_codigo')
			->where('DESCUENTO_PRODUCTO.des_pro_estado', null)
			->orWhere('DESCUENTO_PRODUCTO.des_pro_estado', 1)
			->take('500')
			->get();
		}
		
		return $prod;
	}

}

?>
