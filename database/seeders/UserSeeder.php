<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Akun Admin
        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => Hash::make('pw123'),
            'role'      => 'admin',
        ]);

        // 2. Membuat Akun Peserta
        User::create([
            'name'      => 'Peserta Supernova',
            'email'     => 'peserta@gmail.com',
            'password'  => Hash::make('pw123'),
            'role'      => 'peserta',
        ]);
    }
}