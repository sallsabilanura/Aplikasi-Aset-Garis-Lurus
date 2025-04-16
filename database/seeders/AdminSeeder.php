<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'Alamat' => 'Admin',
            'NoTelp' => '08998261409',
            'Gambar' => 'smku.png',
            'NamaPetugas' => 'Admin Super',
            'Jabatan' => 'Administrator',
            'role' => 'Admin',
        ]);
    }
}
