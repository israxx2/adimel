<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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

    public function despachos()
    {
        return $this->hasMany('App\Despacho', 'dep_cli_idn');
    }

    /**
     * Pregunta si el usuario con ese rut existe
     *
     * @var String $rut
     * @return Boolean
     */
    public static function existe($rut) {
        return DB::table('CLIENTE')
        ->where('cli_rut', $rut)->get()
        ->count();
    }

    /**
     * Retorna las dependencias del cliente de un rut
     *
     * @var String $rut
     * @return Array $dep
     */
    public static function getDependencias($rut) {
        // dd($rut);
        $dep = DB::table('CLIENTE')
        ->join('DEPENDENCIAS_DEL_CLIENTE', 'CLIENTE.cli_idn', '=', 'DEPENDENCIAS_DEL_CLIENTE.cli_idn')
        ->select('DEPENDENCIAS_DEL_CLIENTE.*')
        ->where('CLIENTE.cli_rut', $rut)->get();
        return $dep;
    }

    /**
     * Retorna cli_idn de CLIENTE por medio del rut
     *
     * @var String $rut
     * @return User
     */
    public static function getCliIdn($rut) {
        return DB::table('CLIENTE')
        ->select('cli_idn')
        ->where('cli_rut', $rut)
        ->first()->cli_idn;
    }

    /**
     * Rellena atributos correspondientes a tabla CLIENTE en la instancia
     *
     * @var String $rut
     * @return User
     */
    public function getCliente($rut) {
        $ins = DB::table('CLIENTE')
        ->where('cli_rut', $rut)->first();

        $this->cli_idn              = $ins->cli_idn;
        $this->cli_rut              = $ins->cli_rut;
        $this->cli_razon_social     = $ins->cli_razon_social;
        $this->cli_giro             = $ins->cli_giro;
        $this->cli_traslado         = $ins->cli_traslado;
        $this->tipo                 = $ins->tipo;

        return true;
    }

    /**
     * Retorna el rut sin punto y con guión
     *
     * @var String $rut
     * @return String $rut
     */
    public static function convertirRut($rut) {
        return strtoupper($rut);
        //return strtoupper(substr_replace(strtoupper(str_replace([".","-"],'', $rut)), '-', -1, 0));
    }

    /**
     * Crea registro en tabla CLIENTE
     *
     * @var Instancia: cli_rut, cli_razon_social (nombre)
     * @return Boolean
     */
    public function saveCliente() {
        DB::beginTransaction();
        try {
            //Buscar correlativo CLIENTE
            $id = DB::table('CORRELATIVOS')
            ->where('corre_idn', 1042)->first()->corre_correlativo;

            $this->cli_idn = $id + 1;
            
            //Insertar nuevo cliente
            DB::table('CLIENTE')->insert(
                ['cli_idn'          => $this->cli_idn, //strtoupper(str_replace('.', '', $request->rut)),
                'cli_rut'           => strtoupper($this->cli_rut),
                'cli_razon_social'  => strtoupper($this->dep_cli_nombre),
                'tipo'              => "PARTICULAR",
                'cli_traslado'      => 0]
            );

            //Cambia correlativo CLIENTE
            DB::table('CORRELATIVOS')
            ->where('corre_idn', 1042)
            ->update(['corre_correlativo' =>$this->cli_idn]);

            DB::commit();
            return true;

        } catch (Throwable $e) {
            DB::rollBack();
            return false;
        }
    }

    public function saveDependenciasDelCliente() {
        DB::beginTransaction();
        try {
            //Buscar correlativo CLIENTE
            $id = DB::table('CORRELATIVOS')
            ->where('corre_idn', 1043)->first()->corre_correlativo;

            $this->dep_cli_idn = $id + 1;

            //Insertar nueva dependencia del cliente
            DB::table('DEPENDENCIAS_DEL_CLIENTE')->insert(
                ['dep_cli_idn'      => $this->dep_cli_idn,
                'cli_idn'           => $this->cli_idn,
                'dep_cli_nombre'    => $this->cli_razon_social,
                'cli_giro'          => $this->cli_giro,
                'dep_cli_direccion' => $this->dep_cli_direccion,
                'seg_div_pol_idn'   => $this->seg_div_pol_idn,
                'dep_cli_fono'      => $this->dep_cli_fono,
                //'dep_cli_fax' => " ",
                //'dep_cli_casilla' => " ",
                //'dep_cli_enc_atencion' => " ",
                'cat_idn' => $this->cat_idn, 
                'zon_idn' => $this->zon_idn,
                'dep_cli_descuento' => $this->dep_cli_descuento,
                'ven_idn' => $this->ven_idn,
                'dep_cli_email' => strtoupper($this->dep_cli_email),
                'dep_cli_web' => $this->dep_cli_web,
                'por_uti_idn' => $this->por_uti_idn,
                'dep_cli_estado' => $this->dep_cli_estado,
                //'dep_cli_monaut' => " ",
                'pla_pag_idn' => $this->pla_pag_idn,
                'for_pag_idn' => $this->for_pag_idn,
                //1'dep_cli_saldo_favor' => " ",
                //'dep_cli_ciudad' => " ",
                //'dep_plazo_pago' => " ",
                //'dep_cli_usuario_web' => " ",
                'password' => $this->password
            ]);

            //Cambia correlativo DEPENDENCIA DEL CLIENTE
            DB::table('CORRELATIVOS')
            ->where('corre_idn', 1043)
            ->update(['corre_correlativo' =>$this->dep_cli_idn]);

            DB::commit();
            return true;

        } catch (Throwable $e) {
            DB::rollBack();
            return false;
        }
    }
}
