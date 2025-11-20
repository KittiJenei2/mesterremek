<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BeosztasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('beosztasok')->insert([
            'dolgozo_id' => 1,
            'napok_id'   => 1,  // Hétfő
            'ido_kezdes' => '09:00:00',
            'ido_vege'   => '17:00:00',
        ]);

        // Dolgozó #1 kedden is dolgozik
        DB::table('beosztasok')->insert([
            'dolgozo_id' => 1,
            'napok_id'   => 2,
            'ido_kezdes' => '09:00:00',
            'ido_vege'   => '17:00:00',
        ]);
    }
}
