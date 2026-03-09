<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StreakCharacter;

class StreakCharacterSeeder extends Seeder
{
    public function run()
    {
        // Buat atau update karakter default Slime
        StreakCharacter::updateOrCreate(
            ['nama' => 'Slime'],
            [
                'min_level' => 1,
                'svg_path' => 'streak/pet-1-default.svg', // letakkan file svg di storage/app/public/characters/
                'is_default' => true,
            ]
        );
    }
}