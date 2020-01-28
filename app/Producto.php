<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	protected $fillable = [
		'pro_codigo', 'pro_idn','tip_pro_idn','fam_idn', 'pro_nombre', 'uni_med_idn','pro_costo', 'pro_stock', 'pro_stock_minimo', 'pro_stock_maximo',  'pro_exento',  'pro_porcen1', 'pro_valor_venta1',  'pro_porcen2', 'pro_valor_venta2', 'pro_porcen3', 'pro_valor_venta3', 'pro_porcen4', 'pro_valor_venta4', 'pro_porcen5', 'pro_valor_venta5', 'pro_fecha_ingreso', 'rub_idn', 'pro_estado', 'pro_KIT', 'pro_ppp', 'pro_ultima_compra', 'gru_idn', 'pro_aux', 'fecha_compra', 'cant_compra', 'prov_compra', 'fecha_venta', 'cant_venta', 'con_stock', 'pro_descripcion_web', 'pro_ficha_tecnica', 'pro_web', 'pro_imagen'
	];

	protected $table = 'PRODUCTOS';
	protected $primaryKey = 'pro_idn';
	public $incrementing = false;
	public $timestamps = false;

	public function familia()
    {
        return $this->belongsTo('App\Familia', 'fam_idn');
    }

}
