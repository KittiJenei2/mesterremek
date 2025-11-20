<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SzolgaltatasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('szolgaltatasok')->insert([
            [
                'nev' => 'Női hajvágás',
                'ar' => 6500,
                'idotartam' => 45,
                'lehetosegek_id' => 1, 
                'leiras' => 'Professzionális női hajvágás, szárítással együtt.'
            ],
            [
                'nev' => 'Férfi hajvágás',
                'ar' => 4000,
                'idotartam' => 30,
                'lehetosegek_id' => 1, 
                'leiras' => 'Modern férfi hajvágás, szakáll igazítással.'
            ],
            [
                'nev' => 'Arctisztító kezelés',
                'ar' => 9000,
                'idotartam' => 60,
                'lehetosegek_id' => 2,
                'leiras' => 'Mélytisztítás, peeling, gőzölés, pakolás.'
            ],
            [
                'nev' => 'Relaxáló masszázs',
                'ar' => 12000,
                'idotartam' => 60,
                'lehetosegek_id' => 3,
                'leiras' => 'Teljes testmasszázs relaxációs technikákkal.'
            ],
        ]);
    }
}
