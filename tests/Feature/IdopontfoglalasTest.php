<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Szolgaltatas;
use App\Models\Dolgozo;
use Illuminate\Support\Facades\Mail;
use App\Mail\FoglalasLetrehozva;

class IdopontfoglalasTest extends TestCase
{
    use RefreshDatabase; // Minden teszt futtatása előtt alaphelyzetbe állítja az adatbázist

    public function test_szolgaltatasok_lekerese_kategoria_alapjan()
    {
        // 1. Előkészítés: Létrehozunk egy szolgáltatást
        $szolgaltatas = Szolgaltatas::factory()->create(['lehetosegek_id' => 1]);

        // 2. Végrehajtás: Meghívjuk a kontroller megfelelő metódusát
        $response = $this->json('POST', '/api/szolgaltatasok-kategoria-alapjan', [
            'lehetoseg_id' => 1
        ]);

        // 3. Ellenőrzés: 200-as kód és a helyes név visszaadása
        $response->assertStatus(200)
                 ->assertJsonFragment(['nev' => $szolgaltatas->nev]);
    }

    public function test_foglalas_nem_lehetseges_ha_a_felhasznalo_le_van_tiltva()
    {
        // Előkészítés: Olyan user, aki nem foglalhat
        $user = User::factory()->create(['foglhat' => 0]); 
        $this->actingAs($user);

        $response = $this->json('POST', '/api/idopontfoglalas/store', [
            'szolgaltatas_id' => 1,
            'dolgozo_id' => 1,
            'datum' => '2026-05-20',
            'ido_kezdes' => '10:00'
        ]);

        // Ellenőrzés: 403 Forbidden hiba és a hibaüzenet
        $response->assertStatus(403)
                 ->assertJson(['uzenet' => 'Fiókodhoz az időpontfoglalás le lett tiltva!']);
    }

    public function test_sikeres_foglalas_es_email_kuldes()
    {
        Mail::fake(); // Megakadályozzuk a tényleges email küldést

        $user = User::factory()->create(['foglhat' => 1]);
        $szolgaltatas = Szolgaltatas::factory()->create();
        $dolgozo = Dolgozo::factory()->create();

        $this->actingAs($user);

        $response = $this->json('POST', '/api/idopontfoglalas/store', [
            'szolgaltatas_id' => $szolgaltatas->id,
            'dolgozo_id' => $dolgozo->id,
            'datum' => now()->addDays(1)->toDateString(),
            'ido_kezdes' => '12:00'
        ]);

        $response->assertStatus(200);
        
        // Ellenőrizzük, hogy az email el lett-e "küldve" a háttérben
        Mail::assertSent(FoglalasLetrehozva::class);
    }
}