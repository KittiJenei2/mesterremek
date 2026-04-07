<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Termek;

class TermekSeeder extends Seeder
{
    public function run(): void
    {
        $termekek = [
            // Fodrász (1) termékek
            ['nev' => 'Prémium Hajlakk', 'leiras' => 'Erős tartást biztosító, mégis könnyen kifésülhető hajlakk. Cseresznye illattal.', 'ar' => 4500, 'lehetosegek_id' => 1],
            ['nev' => 'Hővédő Spray', 'leiras' => 'Megóvja a hajat a hajvasaló és a hajszárító okozta hőkárosodástól.', 'ar' => 4200, 'lehetosegek_id' => 1],
            
            // Kozmetikus (2) termékek
            ['nev' => 'Nappali Arckrém', 'leiras' => 'Nappali arckrém hyaluronsavval és aloe verával, minden bőrtípusra.', 'ar' => 7990, 'lehetosegek_id' => 2],
            ['nev' => 'Micellás Víz', 'leiras' => 'Kíméletes, mégis hatékony sminklemosó és arctisztító.', 'ar' => 3500, 'lehetosegek_id' => 2],
            
            // Barber (6) termékek
            ['nev' => 'Szakállolaj', 'leiras' => 'Férfias illatú, tápláló szakállolaj a puhább szakállért.', 'ar' => 5500, 'lehetosegek_id' => 6],
            
            // Körmös (4) termékek
            ['nev' => 'Bőrápoló Olaj', 'leiras' => 'Vitaminokkal dúsított olaj a repedezett körömágybőr ellen.', 'ar' => 2500, 'lehetosegek_id' => 4],
            
            // Sminkes (5) termékek
            ['nev' => 'Fixáló Púder', 'leiras' => 'Hosszantartó sminket biztosító, mattító hatású transzparens púder.', 'ar' => 6200, 'lehetosegek_id' => 5],
        ];

        foreach ($termekek as $termek) {
            Termek::create($termek);
        }
    }
}