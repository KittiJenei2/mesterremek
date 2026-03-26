<?php

namespace Database\Factories;

use App\Models\Lehetoseg;
use Illuminate\Database\Eloquent\Factories\Factory;

class LehetosegFactory extends Factory
{
    protected $model = Lehetoseg::class;

    public function definition(): array
    {
        return [
            'nev' => $this->faker->unique()->randomElement(['Fodrászat', 'Kozmetika', 'Manikűr', 'Masszázs']),
        ];
    }
}