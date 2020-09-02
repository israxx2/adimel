<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Configuracion;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$config = Configuracion::all();
        return view('admin.configuracion.index');
        //->with('config', $config);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $por = Auth::guard('funcionario')->user()->fun_rut;

        $correo = Configuracion::find('correo');
        $correo->titulo = $request->correo;
        $correo->modificado_por = $por;
        $correo->save();

        $direccion = Configuracion::find('direccion');
        $direccion->titulo = $request->direccion;
        $direccion->modificado_por = $por;
        $direccion->save();

        $telefono = Configuracion::find('telefono');
        $telefono->titulo = $request->telefono;
        $telefono->modificado_por = $por;
        $telefono->save();

        $msj_inicio = Configuracion::find('msj_inicio');
        $msj_inicio->titulo = $request->msj_inicio;
        $msj_inicio->modificado_por = $por;
        $msj_inicio->save();

        Session::flash('success', 'Se ha modificado con éxito!');

        return redirect()->route('admin.configuracion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
