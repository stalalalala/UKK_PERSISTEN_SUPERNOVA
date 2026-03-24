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
                'svg_path' => 'streak/default-pet.svg', // letakkan file svg di storage/app/public/characters/
                'svg_animated_path' => 'streak-animasi/default-pet.svg',
                'is_default' => true,
            ]
        );
    }
}