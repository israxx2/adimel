<?php 
namespace App\Helpers;
use App\Carrito;

class Car {

	public static function get($id_user)
	{
		return Carrito::get($id_user);
	}
}

?>
