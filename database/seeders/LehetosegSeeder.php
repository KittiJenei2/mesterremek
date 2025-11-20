<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LehetosegSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lehetosegek')->insert([
            [
                'nev' => 'Fodrász',
                'leiras' => 'Hajvágás, festés, styling, férfi-női szalonmunkák.'
            ],
            [
                'nev' => 'Kozmetikus',
                'leiras' => 'Arckezelések, peeling, hidratálás, smink.'
            ],
            [
                'nev' => 'Masszőr',
                'leiras' => 'Teljes testmasszázs, relaxációs és sportmasszázs.'
            ],
        ]);
    }
}
