<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
		'div_pol_idn', 'div_pol_nombre'
	];

	protected $table = 'REGION';
	protected $primaryKey = 'div_pol_idn';
	public $incrementing = false;
	public $timestamps = false;

	public function ciudades()
	{
		return $this->hasMany('App\Ciudad', 'div_pol_idn');
	}
}
