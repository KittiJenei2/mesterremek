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
                'leiras' => 'Arckezelések, peeling, hidratálás.'
            ],
            [
                'nev' => 'Masszőr',
                'leiras' => 'Teljes testmasszázs, relaxációs és sportmasszázs.'
            ],
            [
                'nev' => 'Körmös',
                'leiras' => 'Manikűr, pedikűr, kézápolás egy helyen.'
            ],
            [
                'nev' => 'Sminkes',
                'leiras' => 'Esküvő? Szalagavató? Hétköznapok könnyítése? Keresd szakembereinket.'
            ],
            [
                'nev' => 'Barber',
                'leiras' => 'Kifejezetten férfiak számára: szakáll, bajusz, haj igazítás.'
            ]
        ]);
    }
}
