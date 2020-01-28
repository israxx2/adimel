<?php 
namespace App\Helpers;
use App\Producto;
use App\Familia;
use Illuminate\Support\Facades\DB;

class Fam {

	public static function get($id)
	{
		return Familia::find($id);
	}

	public static function all() {
		return Familia::all();
	}

}

?>
