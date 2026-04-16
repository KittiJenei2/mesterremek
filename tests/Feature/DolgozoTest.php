<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Dolgozo;
use App\Models\Felhasznalo;
use App\Models\Szolgaltatas;
use App\Models\Idopontfoglalas;

class DolgozoTest extends TestCase
{
    use DatabaseTransactions; // Élő adatbázis védelme itt is kötelező!

    public function test_dolgozo_meg_tudja_nyitni_a_vezerlopultot()
    {
        // 1. Előkészítés: Létrehozunk egy dolgozót, és megmondjuk az IDE-nek a típusát
        /** @var \App\Models\Dolgozo $dolgozo */
        $dolgozo = Dolgozo::factory()->create();
        
        // Bejelentkeztetjük a dolgozót a 'worker' guard használatával!
        $this->actingAs($dolgozo, 'worker');

        // 2. Végrehajtás: Lekérjük a dashboardot
        $response = $this->get('/dolgozo/dashboard');

        // 3. Ellenőrzés: 200 OK és a helyes nézet (view) töltődik be
        $response->assertStatus(200)
                 ->assertViewIs('worker.dashboard');
    }

    public function test_dolgozo_el_tud_fogadni_egy_fuggoben_levo_foglalast()
    {
        // 1. Előkészítés
        /** @var \App\Models\Dolgozo $dolgozo */
        $dolgozo = Dolgozo::factory()->create();
        $felhasznalo = Felhasznalo::factory()->create();
        $szolgaltatas = Szolgaltatas::factory()->create();
        
        $this->actingAs($dolgozo, 'worker');

        // Létrehozunk egy foglalást, amihez a bejelentkezett dolgozó van rendelve (1-es státusz = Függőben)
        $foglalas = Idopontfoglalas::create([
            'felhasznalo_id' => $felhasznalo->id,
            'dolgozo_id' => $dolgozo->id,
            'szolgaltatasok_id' => $szolgaltatas->id,
            'datum' => now()->addDays(2)->format('Y-m-d'),
            'ido_kezdes' => '10:00:00',
            'ido_vege' => '11:00:00',
            'statuszok_id' => 1, 
        ]);

        $response = $this->from('/dolgozo/dashboard')
                         ->post("/dolgozo/foglalas/{$foglalas->id}/elfogadas");

        $response->assertRedirect('/dolgozo/dashboard')
                 ->assertSessionHas('success', 'A foglalást elfogadtad.');

        $this->assertDatabaseHas('idopontfoglalas', [
            'id' => $foglalas->id,
            'statuszok_id' => 2 
        ]);
    }

    public function test_dolgozo_tud_szabadsagot_rogziteni()
    {
        /** @var \App\Models\Dolgozo $dolgozo */
        $dolgozo = Dolgozo::factory()->create();
        $this->actingAs($dolgozo, 'worker');

        // Beállítunk egy jövőbeli szabadság intervallumot
        $kezdes = now()->addDays(10)->format('Y-m-d');
        $vege = now()->addDays(14)->format('Y-m-d');

        // Végrehajtás
        $response = $this->from('/dolgozo/dashboard')->post('/dolgozo/szabadsag', [
            'datum_kezdes' => $kezdes,
            'datum_vege' => $vege
        ]);

        // Ellenőrzés
        $response->assertRedirect('/dolgozo/dashboard')
                 ->assertSessionHas('success', 'Szabadság sikeresen rögzítve.');

        $this->assertDatabaseHas('szabadsagok', [
            'dolgozo_id' => $dolgozo->id,
            'datum_kezdes' => $kezdes,
            'datum_vege' => $vege
        ]);
    }
}