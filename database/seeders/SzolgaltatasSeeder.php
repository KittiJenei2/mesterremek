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
        DB::table('szolgaltatasok')->insertOrIgnore([
            [
                'nev' => 'Női hajvágás',
                'ar' => 6500,
                'idotartam' => 45,
                'lehetosegek_id' => 1, 
                'leiras' => 'Professzionális női hajvágás, szárítással együtt.'
            ],
            [
                'nev' => 'Hajszárítás, igazítás',
                'ar' => 6000,
                'idotartam' => 45,
                'lehetosegek_id' => 1,
                'leiras' => 'Haj beszárítása, göndörítése/egyenesítése hajmosás nélkül!'
            ],
            [
                'nev' => 'Férfi hajvágás',
                'ar' => 4000,
                'idotartam' => 30,
                'lehetosegek_id' => 1, 
                'leiras' => 'Modern férfi hajvágás, szakáll igazítással.'
            ],
            [
                'nev' => 'Szakáll- és bajuszigazítás',
                'ar' => 6000,
                'idotartam' => 30,
                'lehetosegek_id' => 6,
                'leiras' => 'Férfiak számára, az arc szépítésére, puhítására.'
            ],
            [
                'nev' => 'Arctisztító kezelés',
                'ar' => 9000,
                'idotartam' => 60,
                'lehetosegek_id' => 2,
                'leiras' => 'Mélytisztítás, peeling, gőzölés, pakolás.'
            ],
            [
                'nev' => 'Arcmasszázs',
                'ar' => 9000,
                'idotartam' => 35,
                'lehetosegek_id' => 2,
                'leiras' => 'Arcpakolás és arcmasszázs összekötve!'
            ],
            [
                'nev' => 'Tini arckezelés',
                'ar' => 9000,
                'idotartam' => 60,
                'lehetosegek_id' => 2,
                'leiras' => 'Kifejezetten tinédzserek számára: pattanáskezelés, hegek enyhítése, arc puhítása.'
            ],
            [
                'nev' => 'Relaxáló masszázs',
                'ar' => 12000,
                'idotartam' => 60,
                'lehetosegek_id' => 3,
                'leiras' => 'Teljes testmasszázs relaxációs technikákkal.'
            ],
            [
                'nev' => 'Hátmasszázs',
                'ar' => 10000,
                'idotartam' => 45,
                'lehetosegek_id' => 3,
                'leiras' => 'Hátizmok fókuszban!'
            ],
            [
                'nev' => 'Kar- és lábmasszázs',
                'ar' => 6000,
                'idotartam' => 30,
                'lehetosegek_id' => 3,
                'leiras' => 'Karok és lábak relaxáló kezelése.'
            ],
            [
                'nev' => 'Manikűr',
                'ar' => 7000,
                'idotartam' => 90,
                'lehetosegek_id' => 4,
                'leiras' => 'Sima, egyszerű manikűr minta nélkül, kézmasszázzsal.'
            ],
                        
            [
                'nev' => 'Manikűr',
                'ar' => 7000,
                'idotartam' => 90,
                'lehetosegek_id' => 4,
                'leiras' => 'Sima, egyszerű manikűr minta nélkül, kézmasszázzsal.'
            ],
                                    
            [
                'nev' => 'Manikűr mintával',
                'ar' => 12000,
                'idotartam' => 120,
                'lehetosegek_id' => 4,
                'leiras' => 'Manikűr bármilyen mintával, kézmasszázzsal (Az ár mérettől független).'
            ],
            
            [
                'nev' => 'Elegáns smink',
                'ar' => 8000,
                'idotartam' => 90,
                'lehetosegek_id' => 5,
                'leiras' => 'Esküvő, szalagavató, rendezvény.'
            ],
                                    
            [
                'nev' => 'Hétköznapi smink',
                'ar' => 4000,
                'idotartam' => 60,
                'lehetosegek_id' => 5,
                'leiras' => 'Sima, egyszerű smink a hétköznapokra.'
            ],
        ]);
    }
}
