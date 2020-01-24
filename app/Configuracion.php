<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
	protected $fillable = [
		'conf_idn ', 'titulo ', 'modificado_por ', 'fecha_modificado ', 'estado ',
	];

	protected $table = 'web_configuracion';
	protected $primaryKey = 'conf_idn';
	public $incrementing = false;
	public $timestamps = false;
}
