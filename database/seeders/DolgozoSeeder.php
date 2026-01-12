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
            [
                'nev' => 'Szabó Éva', 
                'email' => 'eva@freshszalon.hu', 
                'telefon' => '06201112235', 
                'jelszo' => Hash::make('titkos'), 
                'bio' => 'Sminkes', 
                'kep' => 'eva.jpg'
            ],
            [
                'nev' => 'Varga Judit', 
                'email' => 'judit@freshszalon.hu', 
                'telefon' => '06201112236', 
                'jelszo' => Hash::make('titkos'), 
                'bio' => 'Körmös.', 
                'kep' => 'judit.jpg'
            ],
        ['nev' => 'Kiss Péter', 'email' => 'peter@freshszalon.hu', 'telefon' => '06201112237', 'jelszo' => Hash::make('titkos'), 'bio' => 'Gyógymasszőr.', 'kep' => 'peter.jpg'],
        ['nev' => 'Tóth Zsuzsa', 'email' => 'zsuzsa@freshszalon.hu', 'telefon' => '06201112238', 'jelszo' => Hash::make('titkos'), 'bio' => 'Pedikűrös.', 'kep' => 'zsuzsa.jpg'],
        ['nev' => 'Horváth Ádám', 'email' => 'adam@freshszalon.hu', 'telefon' => '06201112239', 'jelszo' => Hash::make('titkos'), 'bio' => 'Fodrász tanuló.', 'kep' => 'adam.jpg'],
        ['nev' => 'Molnár Kinga', 'email' => 'kinga@freshszalon.hu', 'telefon' => '06201112240', 'jelszo' => Hash::make('titkos'), 'bio' => 'Sminkes.', 'kep' => 'kinga.jpg'],
        ['nev' => 'Farkas Dóra', 'email' => 'dora@freshszalon.hu', 'telefon' => '06201112241', 'jelszo' => Hash::make('titkos'), 'bio' => 'Szempilla stylist.', 'kep' => 'dora.jpg'],
        ['nev' => 'Balogh Tamás', 'email' => 'tamas@freshszalon.hu', 'telefon' => '06201112242', 'jelszo' => Hash::make('titkos'), 'bio' => 'Masszőr.', 'kep' => 'tamas.jpg'],
        ]);
    }
}
