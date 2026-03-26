<?php

namespace Database\Factories;

use App\Models\Szolgaltatas;
use App\Models\Lehetoseg;
use Illuminate\Database\Eloquent\Factories\Factory;

class SzolgaltatasFactory extends Factory
{
    protected $model = Szolgaltatas::class;

    public function definition(): array
    {
        return [
            'nev' => $this->faker->word() . ' kezelés',
            'ar' => $this->faker->numberBetween(2000, 25000),
            'idotartam' => $this->faker->randomElement([30, 45, 60, 90]), // Percekben
            'lehetosegek_id' => Lehetoseg::factory(), // Automatikusan létrehoz egy kategóriát, ha nincs megadva
            'leiras' => $this->faker->sentence(),
        ];
    }
}