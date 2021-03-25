<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
    }

    protected function validateLogin(Request $request)
    {
        try {
            $request->validate([
                $this->username() => 'required|string',
                'password' => 'required|string',
            ], []);
        } catch (ValidationException $exception) {
            session()->flash('error-login', __('Las credenciales son incorrectas'));
            return back();
        }

    }

    protected function sendFailedLoginResponse(Request $request)
    {
        session()->flash('error-login', 'Las credenciales son incorrectas');
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    protected function redirectPath()
    {
        if (auth()->user()->isTeacher()){
            return "/teacher";
        }
        return "/";
    }
}
