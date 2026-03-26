<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StatuszFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Alapértelmezett státuszok a rendszerben
            'nev' => $this->faker->unique()->randomElement(['Függőben', 'Visszaigazolva', 'Lemondva', 'Teljesítve']),
        ];
    }
}