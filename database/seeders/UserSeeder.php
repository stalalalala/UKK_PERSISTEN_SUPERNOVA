<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat atau Update Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // Kunci pencarian
            [
                'name'     => 'Administrator',
                'password' => Hash::make('pw123'),
                'role'     => 'admin',
            ]
        );

        // 2. Membuat atau Update Akun Peserta
        User::updateOrCreate(
            ['email' => 'peserta@gmail.com'], // Kunci pencarian
            [
                'name'     => 'Peserta Supernova',
                'password' => Hash::make('pw123'),
                'role'     => 'peserta',
            ]
        );
    }
}