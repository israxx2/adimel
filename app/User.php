<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //Rut: cli_idn, clave: password
    protected $fillable = [
        'dep_cli_idn', 'cli_idn', 'dep_cli_nombre', 'cli_giro', 'dep_cli_direccion', 'seg_div_pol_idn', 'dep_cli_fono', 'dep_cli_fax', 'dep_cli_casilla', 'cat_idn', 'zon_idn', 'password', 'dep_cli_usuario_web', 'dep_cli_email', 'dep_cli_web', 'dep_cli_fecha_ingreso', 'dep_cli_estado' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $table = 'DEPENDENCIAS_DEL_CLIENTE';
    protected $primaryKey = 'dep_cli_idn';
    public $incrementing = false;
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = false;

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
    
    public function carrito()
    {
        return $this->hasMany('App\Carrito', 'dep_cli_idn');
    }
}
