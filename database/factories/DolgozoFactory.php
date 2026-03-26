<?php

namespace Database\Factories;

use App\Models\Dolgozo;
use Illuminate\Database\Eloquent\Factories\Factory;

class DolgozoFactory extends Factory
{
    protected $model = Dolgozo::class;

    public function definition(): array
    {
        return [
            'nev' => $this->faker->name(),
            // Ha van profilkép meződ, ide jöhet egy alapértelmezett string vagy faker kép URL
        ];
    }
}