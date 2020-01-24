<?php 
namespace App\Helpers;
use App\Configuracion;

class Config {

	public static function get($id)
	{
		return Configuracion::find($id);
	}
}

?>
