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
        DB::table('beosztasok')->insertOrIgnore([
            [
                'dolgozo_id' => 1,
                'napok_id'   => 1,
                'ido_kezdes' => '09:00:00',
                'ido_vege'   => '17:00:00',
            ],
            [
                'dolgozo_id' => 1,
                'napok_id'   => 2,
                'ido_kezdes' => '09:00:00',
                'ido_vege'   => '17:00:00',
            ],
            [
                'dolgozo_id' => 2,
                'napok_id'   => 2,
                'ido_kezdes' => '09:00:00',
                'ido_vege'   => '17:30:00',
            ],
            [
                'dolgozo_id' => 2,
                'napok_id'   => 3,
                'ido_kezdes' => '09:00:00',
                'ido_vege'   => '17:30:00',
            ],
            [
                'dolgozo_id' => 2,
                'napok_id'   => 4,
                'ido_kezdes' => '09:00:00',
                'ido_vege'   => '17:30:00',
            ],
            [
                'dolgozo_id' => 3,
                'napok_id'   => 1,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '15:00:00',
            ],
            [
                'dolgozo_id' => 3,
                'napok_id'   => 3,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '15:00:00',
            ],
            [
                'dolgozo_id' => 3,
                'napok_id'   => 5,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '17:00:00',
            ],
            [
                'dolgozo_id' => 4,
                'napok_id'   => 2,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '15:00:00',
            ],
            [
                'dolgozo_id' => 4,
                'napok_id'   => 4,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '15:00:00',
            ],
            [
                'dolgozo_id' => 4,
                'napok_id'   => 6,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '15:00:00',
            ],

            [
                'dolgozo_id' => 5,
                'napok_id'   => 1,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '14:00:00',
            ],
                        
            [
                'dolgozo_id' => 5,
                'napok_id'   => 2,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '14:00:00',
            ],
                        
            [
                'dolgozo_id' => 5,
                'napok_id'   => 3,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '14:00:00',
            ],
                        
            [
                'dolgozo_id' => 5,
                'napok_id'   => 4,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '14:00:00',
            ],
            
            [
                'dolgozo_id' => 6,
                'napok_id'   => 1,
                'ido_kezdes' => '09:00:00',
                'ido_vege'   => '18:00:00',
            ],
                        
            [
                'dolgozo_id' => 6,
                'napok_id'   => 3,
                'ido_kezdes' => '09:00:00',
                'ido_vege'   => '18:00:00',
            ],
       
            [
                'dolgozo_id' => 6,
                'napok_id'   => 5,
                'ido_kezdes' => '09:00:00',
                'ido_vege'   => '18:00:00',
            ],
                        
            [
                'dolgozo_id' => 7,
                'napok_id'   => 1,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '16:00:00',
            ],
                                    
            [
                'dolgozo_id' => 7,
                'napok_id'   => 3,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '16:00:00',
            ],
                                    
            [
                'dolgozo_id' => 8,
                'napok_id'   => 1,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '18:00:00',
            ],
                        [
                'dolgozo_id' => 8,
                'napok_id'   => 2,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '18:00:00',
            ],

            [
                'dolgozo_id' => 8,
                'napok_id'   => 4,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '18:00:00',
            ],

            [
                'dolgozo_id' => 8,
                'napok_id'   => 5,
                'ido_kezdes' => '10:00:00',
                'ido_vege'   => '18:00:00',
            ],
        ]);
    }
}
