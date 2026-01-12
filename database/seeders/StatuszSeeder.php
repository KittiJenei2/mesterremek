<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatuszSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuszok = ['Függőben', 'Elfogadva', 'Elutasítva', 'Elvégezve'];

        foreach ($statuszok as $stat) {
            DB::table('statuszok')->insert([
                'nev' => $stat
            ]);
        }
    }
}
