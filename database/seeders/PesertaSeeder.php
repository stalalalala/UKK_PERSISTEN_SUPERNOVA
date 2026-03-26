<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PesertaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data dummy menggunakan looping untuk 5 peserta
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name'              => "PS $i",
                'email'             => "ps$i@gmail.com",
                'no_hp'            => '0812345678' . $i,
                'password'          => Hash::make('pw_123'), // Memenuhi regex login Anda
                'role'              => 'peserta',
                'email_verified_at' => now(), // Bypass verifikasi email
                'remember_token'    => Str::random(10),
            ]);
        }

        $this->command->info('5 Peserta baru berhasil ditambahkan tanpa perlu verifikasi email.');
    }
}