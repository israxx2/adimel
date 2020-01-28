<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    protected $fillable = [
		'FAM_IDN ', 'FAM_DETALLE ', 'FAM_ESTADO',
	];

	protected $table = 'FAMILIA';
	protected $primaryKey = 'FAM_IDN';
	public $incrementing = false;
	public $timestamps = false;

	public function productos()
	{
		return $this->hasMany('App\Producto', 'fam_idn');
	}
}
