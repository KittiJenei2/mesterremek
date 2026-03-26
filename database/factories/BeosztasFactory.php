<?php

namespace Database\Factories;

use App\Models\Beosztas;
use App\Models\Dolgozo;
use App\Models\Napok;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeosztasFactory extends Factory
{
    protected $model = Beosztas::class;

    public function definition(): array
    {
        return [
            'dolgozo_id' => Dolgozo::factory(),
            'napok_id' => $this->faker->numberBetween(1, 7),
            'ido_kezdes' => '08:00',
            'ido_vege' => '16:00',
        ];
    }
}