<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Despacho extends Model
{
	protected $fillable = [
		'desp_idn', 'dep_cli_idn', 'seg_div_pol_idn', 'direccion', 'numero', 'telefono'
	];

	protected $table = 'web_despacho';
	protected $primaryKey = 'desp_idn';

	//Retorna la entidad del cliente
	public function cliente()
	{
		return $this->belongsTo('App\Cliente', 'dep_cli_idn');
	}

	public function ciudad()
	{
		return $this->belongsTo('App\Ciudad', 'seg_div_pol_idn');
	}	
}
