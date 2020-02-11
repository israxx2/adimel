<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
	protected $fillable = [
		'seg_div_pol_idn', 'seg_div_pol_nombre', 'div_pol_idn', 'seg_div_cod_area'
	];

	protected $table = 'SEG_DIV_POL';
	protected $primaryKey = 'seg_div_pol_idn';
	public $incrementing = false;
	public $timestamps = false;

	public function despachos()
	{
		return $this->hasMany('App\Despacho', 'seg_div_pol_idn');
	}
}
