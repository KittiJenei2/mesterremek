<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SzolgaltatokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('szolgaltatok')->insertOrIgnore([
            [
                'dolgozo_id' => 1,
                'lehetosegek_id' => 2,
            ],

            [
                'dolgozo_id' => 2,
                'lehetosegek_id' => 1,
            ],
            
            [
                'dolgozo_id' => 2,
                'lehetosegek_id' => 6,
            ],

            [
                'dolgozo_id' => 3,
                'lehetosegek_id' => 3,
            ],
            
            [
                'dolgozo_id' => 4,
                'lehetosegek_id' => 5,
            ],
            
            [
                'dolgozo_id' => 5,
                'lehetosegek_id' => 4,
            ],
            
            [
                'dolgozo_id' => 6,
                'lehetosegek_id' => 3,
            ],
            
            [
                'dolgozo_id' => 7,
                'lehetosegek_id' => 5,
            ],
            
            [
                'dolgozo_id' => 8,
                'lehetosegek_id' => 2,
            ],
        ]);
    }
}
