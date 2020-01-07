<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'DEPENDENCIAS_DEL_CLIENTE';

    protected $primaryKey = 'dep_cli_idn';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //Rut: cli_idn, clave: dep_cli_clave_web
    protected $fillable = [
        'dep_cli_idn', 'cli_idn', 'dep_cli_nombre', 'cli_giro', 'dep_cli_direccion', 'seg_div_pol_idn', 'dep_cli_fono', 'dep_cli_fax', 'dep_cli_casilla', 'cat_idn', 'zon_idn', 'dep_cli_clave_web', 'dep_cli_usuario_web', 'dep_cli_email', 'dep_cli_web', 'dep_cli_fecha_ingreso', 'dep_cli_estado' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'dep_cli_clave_web',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * Get the password for the user.
    *
    * @return string
    */
    public function getAuthPassword()
    {
        return $this->dep_cli_clave_web;
    }
}
