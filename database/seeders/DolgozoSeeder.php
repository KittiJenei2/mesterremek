<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DolgozoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dolgozo')->insert([
            [
                'nev' => 'Nagy Anna',
                'email' => 'anna@example.com',
                'telefon' => '06203334444',
                'jelszo' => Hash::make('titkos'),
                'bio' => 'Kozmetikus 5 év tapasztalattal',
                'kep' => 'anna.jpg'
            ],
            [
                'nev' => 'Kiss Petra',
                'email' => 'petra@example.com',
                'telefon' => '06203335555',
                'jelszo' => Hash::make('titkos'),
                'bio' => 'Férfi és női fodrász egyben!',
                'kep' => 'petra.jpg'
            ],
            [
                'nev' => 'Szabó Ádám',
                'email' => 'adam@example.com',
                'telefon' => '06203336666',
                'jelszo' => Hash::make('titkos'),
                'bio' => 'Férfi fodrász, borbély szolgáltatásokkal',
                'kep' => 'adam.jpg'
            ],
        ]);
    }
}
