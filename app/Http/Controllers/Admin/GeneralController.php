<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.productos.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function configuracion()
    {
        return view('admin.configuracion.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $productos= DB::table('PRODUCTOS')
        ->where([
            ['pro_idn', $id],
        ])->get();

        return view('admin.productos.edit')
        ->with('p', $productos->first());

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


    public function imagenes()
    {
        return view('admin.imagenes.crop');
    }

    public function imageCropPost(Request $request)

    {
        $data = $request->image;
        $id= $request->id;
        
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);

        $path = public_path() . "/uploads/productos/" . $id . '.png';
        error_log($path);
        file_put_contents($path, $data);
        return response()->json(['success'=>'done']);

    }

    public function mercado()
    {
        return view('admin.mercado.index');
    }
    public function ofertas()
    {
        return view('admin.ofertas.index');
    }
    public function UploadFile(Request $request)
    {   
        $tipo=$request->tipo;
        $file = $request->file('file');
        $filename = $request->file('file')->getClientOriginalName();
        $extension=\File::extension($filename);


        $path = public_path() . "/uploads/mercado/" .$tipo .$filename;
        error_log($path);
        $request->file('file')->move(public_path('/mercado'), $tipo.'.'.$extension);
        return response()->json(['success'=>'done']);
    }
    
    public function funcionarioLogout(request $request) {
        $this->guard('funcionario')->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }

}
