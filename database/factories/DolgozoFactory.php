<?php

namespace Database\Factories;

use App\Models\Dolgozo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class DolgozoFactory extends Factory
{
    protected $model = Dolgozo::class;

    public function definition(): array
    {
        return [
            'nev' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefon' => fake()->phoneNumber(),
            'jelszo' => Hash::make('password'), // Alapértelmezett jelszó a tesztekhez
            'bio' => fake()->sentence(),
            'kep' => 'default_kep.jpg',
        ];
    }
}