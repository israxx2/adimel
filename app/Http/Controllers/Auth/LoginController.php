<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Funcionario;
use App\User;

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
        $this->middleware('guest:funcionario')->except('logout');
    }

    public function adimelLogin()
    {
        return view('admin.login');
    }

    public function clienteLogin(Request $request)
    {
        $data = array('status' => true, 'errors' => null);
        //Le quita los puntos y deja todo mayusculas el rut:
        //Ej: 19.105.900-k -> 19105900-K
        $request->merge(['login_rut' => strtoupper(str_replace('.', '', $request->login_rut))]);

        $user = User::getDependencias($request->login_rut);
        //Valida
        $reglas['login_rut'] = "required";
        $msjs['login_rut.required'] = "El rut es obligatorio";
        $reglas['login_pw'] = 'required';
        $msjs['login_pw.required'] = "La contraseña es obligatoria.";
        if(count($user) >= 1) {
            $reglas['dependencias'] = "required";
            $msjs['dependencias.required'] = "La sucursal es obligatoria";
        }

        $validator = \Validator::make($request->all(), $reglas, $msjs);
        if ($validator->fails())
        {
            $data['errors'] = response()->json(['errors'=>$validator->errors()]);
            return $data;
        }
        //Si se crea el guardia (si se loguea) .....
        if (!Auth::guard('cliente')->attempt(['cli_idn' => $request->login_rut, 'password' => $request->login_pw], $request->filled('remember'))) {

            $data['errors'] = [
                'original' => [
                    'errors' => [
                        'login_rut' => ['Las credenciales no coinciden.']
                    ]
                ]                
            ];

        } 
        return $data;
    }

    public function funcionarioLogin(Request $request)
    {
        //dd($request->input());
        $this->validate($request, [
            'rut'       => 'required',
            'password'  => 'required|min:6'
        ]);

        $funcionario = Funcionario::where('fun_rut', strtoupper($request->rut))
        ->where('fun_password', $request->password)->first();

        //dd($funcionario);

        if($funcionario) {

            $funcionario->password = bcrypt($funcionario->fun_password);
            $funcionario->save();

            if (Auth::guard('funcionario')->attempt(['fun_rut' => $request->rut, 'password' => $request->password], $request->filled('remember'))) {
                return redirect('/adimel');
            }
        } 

        return redirect(route('login_view'))->withInput();
    }

    public function funcionarioLogout(Request $request)
    {
        $this->guard('funcionario')->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    public function clienteLogout(Request $request)
    {
        $this->guard('funcionario')->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
