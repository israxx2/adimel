<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cliente;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:cliente')->except('logout');
    }


    public function clienteLogin(Request $request)
    {
        //Le quita los puntos y deja todo mayusculas el rut:
        //Ej: 19.105.900-k -> 19105900-K
        $request->merge(['rut' => strtoupper(str_replace('.', '', $request->rut))]);

        //Valida
        $this->validate($request, [
            'rut'   => 'required',
            'pw'    => 'required|min:6'
        ]);

        //Si se crea el guardia (si se loguea) .....
        if (Auth::guard('cliente')->attempt(['cli_idn' => $request->rut, 'password' => $request->pw], $request->filled('remember'))) {
            return redirect('/');
        }
        dd("falló");
        return back()->withInput($request->only('rut'));
    }
}
