<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'Gambar' => ['nullable', 'image', 'max:2048'], // Menambahkan validasi gambar
        ]);
    }

    protected function create(array $data)
    {
        // Menangani upload gambar jika ada
        $gambarPath = null;
        if (isset($data['Gambar'])) {
            // Meng-upload gambar dan menyimpannya di folder 'public/images'
            $gambarPath = $data['Gambar']->store('images', 'public');
        }

        // Membuat user dan menyimpan path gambar di database
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'Alamat' => $data['Alamat'] ?? null,
            'NoTelp' => $data['NoTelp'] ?? null,
            'Gambar' => $gambarPath,  // Menyimpan path gambar
            'NamaPetugas' => $data['NamaPetugas'] ?? null,
            'Jabatan' => $data['Jabatan'] ?? null,
            'role' => $data['role'] ?? 'Instansi',
        ]);
    }
}
