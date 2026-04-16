<?php

namespace Database\Factories;

use App\Models\Felhasznalo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class FelhasznaloFactory extends Factory
{
    protected $model = Felhasznalo::class;

    public function definition(): array
    {
        return [
            'nev' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefonszam' => fake()->numerify('06#########'), // Pl: 06301234567
            'jelszo' => Hash::make('password'),
            'keszitve' => now(),
            'velemenyt_irhat' => 1,
            'foglalhat' => 1,
        ];
    }
}