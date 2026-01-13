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
        $password = Hash::make('password');

        DB::table('dolgozo')->insertOrIgnore([
            [

                'nev' => 'Nagy Anna',
                'email' => 'anna@example.com',
                'telefon' => '06203334444',
                'jelszo' => $password,
                'bio' => 'Kozmetikus 5 év tapasztalattal',
                'kep' => 'anna.jpg'
            ],
            [
                'nev' => 'Kiss Petra',
                'email' => 'petra@example.com',
                'telefon' => '06203335555',
                'jelszo' => $password,
                'bio' => 'Férfi és női fodrász egyben!',
                'kep' => 'petra.jpg'
            ],
            [
                'nev' => 'Szabó Ádám',
                'email' => 'adam@example.com',
                'telefon' => '06203336666',
                'jelszo' => $password,
                'bio' => 'Férfi fodrász, borbély szolgáltatásokkal',
                'kep' => 'adam.jpg'
            ],
            [
                'nev' => 'Szabó Éva', 
                'email' => 'eva@freshszalon.hu', 
                'telefon' => '06201112235', 
                'jelszo' => $password, 
                'bio' => 'Sminkes', 
                'kep' => 'eva.jpg'
            ],
            [
                'nev' => 'Varga Judit', 
                'email' => 'judit@freshszalon.hu', 
                'telefon' => '06201112236', 
                'jelszo' => $password, 
                'bio' => 'Körmös.', 
                'kep' => 'judit.jpg'
            ],
            [
                'nev' => 'Kiss Péter', 
                'email' => 'peter@freshszalon.hu', 
                'telefon' => '06201112237', 
                'jelszo' => $password, 
                'bio' => 'Gyógymasszőr.', 
                'kep' => 'peter.jpg'
            ],
            [
                'nev' => 'Tóth Zsuzsa', 
                'email' => 'zsuzsa@freshszalon.hu', 
                'telefon' => '06201112238', 
                'jelszo' => $password, 
                'bio' => 'Sminkes.', 
                'kep' => 'zsuzsa.jpg'
            ],
            [
                'nev' => 'Horváth Zoltán', 
                'email' => 'zoltan@freshszalon.hu', 
                'telefon' => '06201112239', 
                'jelszo' => $password, 
                'bio' => 'Kozmetikus.', 
                'kep' => 'zoltan.jpg'
            ],
        ]);
    }
}
