<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Funcionario extends Authenticatable
{
	use Notifiable;

	protected $guard = 'funcionario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //Rut: fun_rut, clave: fun_password
    protected $fillable = [
    	'fun_idn', 'fun_rut', 'fun_password', 'fun_nombre', 'fun_ap_paterno', 'fun_ap_materno', 'fun_direccion', 'seg_div_pol_idn', 'fun_fono', 'fun_fecha_ing', 'fun_estado', 'fun_fecha_sis', 'fun_cam_costo_venta'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'fun_password',
    ];

    protected $table = 'FUNCIONARIOS';
    protected $primaryKey = 'fun_idn';
    public $incrementing = false;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */    
    protected $casts = [
    	'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;
    /**
    * Get the password for the user.
    *
    * @return string
    */
    public function getAuthIdentifier()
    {
    	return $this->getKey();
    }
    
    public function getAuthPassword()
    {
        return $this->password;
    }
}
