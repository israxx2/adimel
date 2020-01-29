<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Carrito extends Model
{
	protected $fillable = [
		'conf_idn ', 'dep_cli_idn ', 'prod_codigo ', 'prod_nombre ', 'cantidad '
	];

	protected $table = 'web_carrito';
	protected $primaryKey = 'car_idn';
	//public $incrementing = true;
	//public $timestamps = false;

	//Retorna la entidad del producto relacionado
	public function producto()
	{
		return $this->belongsTo('App\Producto', 'prod_codigo');
	}

	//Retorna al cliente que agregó ese articulo al carrito
	public function cliente()
	{
		return $this->belongsTo('App\Cliente', 'dep_cli_idn');
	}

	//entrada: id del cliente
	//retorna: todos los articulos que pertenecen al carrito
	public function get($dep_cli_idn) {
		$carrito = $this->orderBy('conf_idn', 'ASC')
		->where('dep_cli_idn', $dep_cli_idn)->get();

		return $carrito;
	}
}
