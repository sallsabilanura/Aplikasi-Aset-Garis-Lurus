<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;     



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

    public function login(Request $request)
{
    // Validasi login
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Mengecek apakah user aktif
        $user = Auth::user();
        if ($user->Status === 'Nonaktif') {
            Auth::logout(); // Logout pengguna yang nonaktif
            return redirect()->route('login')->with('error', 'Akun Anda telah dinonaktifkan.');
        }

        return redirect()->intended('dashboard');
    }

    return redirect()->route('login')->with('error', 'Email atau password salah.');
}
}
