<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Felhasznalo; // User cserélve Felhasznalora
use App\Models\Szolgaltatas;
use App\Models\Dolgozo;
use App\Models\Lehetoseg;
use App\Models\Idopontfoglalas;
use Illuminate\Support\Facades\Mail;
use App\Mail\FoglalasLetrehozva;

class IdopontfoglalasTest extends TestCase
{
    use DatabaseTransactions; // Minden teszt futtatása előtt alaphelyzetbe állítja a memóriában futó sqlite adatbázist

    public function test_szolgaltatasok_lekerese_kategoria_alapjan()
    {
        // 1. Előkészítés: Létrehozunk egy kategóriát (lehetőséget) és egy hozzá tartozó szolgáltatást
        $lehetoseg = Lehetoseg::factory()->create();
        $szolgaltatas = Szolgaltatas::factory()->create(['lehetosegek_id' => $lehetoseg->id]);

        // 2. Végrehajtás: GET kérés a web.php alapján, a szükséges query paraméterrel átadva
        $response = $this->json('GET', '/szolgaltatasok-kategoria-alapjan', [
            'lehetoseg_id' => $lehetoseg->id
        ]);

        // 3. Ellenőrzés: 200-as kód és a helyes név visszaadása
        $response->assertStatus(200)
                 ->assertJsonFragment(['nev' => $szolgaltatas->nev]);
    }

    public function test_szakemberek_lekerese_szolgaltatas_alapjan()
    {
        $szolgaltatas = Szolgaltatas::factory()->create();
        $dolgozo = Dolgozo::factory()->create();

        $response = $this->json('GET', '/dolgozok-szolgaltatas-alapjan', [
            'szolgaltatas_id' => $szolgaltatas->id
        ]);

        $response->assertStatus(200);
    }

    public function test_foglalas_nem_lehetseges_ha_a_felhasznalo_le_van_tiltva()
    {
        // Előkészítés: Olyan user, aki nem foglalhat
        /** @var \App\Models\Felhasznalo $user */
        $user = Felhasznalo::factory()->create(['foglalhat' => 0]); 
        $this->actingAs($user);

        // Végrehajtás: Nincs /api prefix a web.php alapján
        $response = $this->json('POST', '/idopontfoglalas/store', [
            'szolgaltatas_id' => 1,
            'dolgozo_id' => 1,
            'datum' => '2026-05-20',
            'ido_kezdes' => '10:00'
        ]);

        // Ellenőrzés: 403 Forbidden hiba és a pontos hibaüzenet
        $response->assertStatus(403)
                 ->assertJson(['uzenet' => 'Fiókodhoz az időpontfoglalás le lett tiltva!']);
    }

    public function test_sikeres_foglalas_es_email_kuldes()
    {
        Mail::fake(); // Megakadályozzuk a tényleges email küldést a teszt során

        // Előkészítjük az adatbázist azokkal az adatokkal, amik a foglaláshoz kellenek
        /** @var \App\Models\Felhasznalo $user */
        $user = Felhasznalo::factory()->create(['foglalhat' => 1]);
        $lehetoseg = Lehetoseg::factory()->create();
        $szolgaltatas = Szolgaltatas::factory()->create(['lehetosegek_id' => $lehetoseg->id, 'idotartam' => 60]);
        $dolgozo = Dolgozo::factory()->create();

        $this->actingAs($user); // Bejelentkeztetjük a felhasználót

        $response = $this->json('POST', '/idopontfoglalas/store', [
            'szolgaltatas_id' => $szolgaltatas->id,
            'dolgozo_id' => $dolgozo->id,
            'datum' => now()->addDays(1)->toDateString(),
            'ido_kezdes' => '12:00'
        ]);

        // Ellenőrzés: Sikeres válasz (200) és a JSON üzenet ellenőrzése
        $response->assertStatus(200)
                 ->assertJson(['uzenet' => 'Foglalás sikeresen mentve!']);
        
        // Ellenőrizzük, hogy az email el lett-e "küldve" a háttérben
        Mail::assertSent(FoglalasLetrehozva::class);
    }

    public function test_foglalas_megjelenik_a_profil_fulon()
    {
        /** @var \App\Models\Felhasznalo $user */
        $user = Felhasznalo::factory()->create();
        $this->actingAs($user);

        $szolgaltatas = Szolgaltatas::factory()->create();

        // Foglalást manuálisan bedobjuk az adatbázisba
        $foglalas = Idopontfoglalas::create([
            'felhasznalo_id' => $user->id,
            'dolgozo_id' => Dolgozo::factory()->create()->id,
            'szolgaltatasok_id' => $szolgaltatas->id,
            'datum' => now()->addDays(2)->format('Y-m-d'),
            'ido_kezdes' => '10:00:00',
            'ido_vege' => '11:00:00',
            'statuszok_id' => 1,
        ]);

        // Megnyitjuk a Profil oldalt
        $response = $this->get('/profil'); // Kérlek ellenőrizd az útvonalat (lehet, hogy nálad /profile)

        // Ellenőrizzük, hogy kiírja-e a szolgáltatás nevét
        $response->assertStatus(200)
                 ->assertSee($szolgaltatas->nev);
    }

    public function test_szabad_idopontok_ures_ha_a_dolgozo_szabadsagon_van()
    {
        // 1. Előkészítés
        $dolgozo = Dolgozo::factory()->create();
        $szolgaltatas = Szolgaltatas::factory()->create(['idotartam' => 60]);

        // A teszt dátuma dinamikusan a következő Hétfő lesz
        $tesztDatum = now()->next('Monday')->toDateString();
        
        // Lekérjük a Hétfő ID-ját a normál adatbázisodból
        $nap = \App\Models\Napok::where('nev', 'Hétfő')->first();

        // 2. Beosztás: Hétfőn elvileg dolgozna 08:00-tól 16:00-ig
        \App\Models\Beosztas::insert([
            'dolgozo_id' => $dolgozo->id,
            'napok_id' => $nap->id,
            'ido_kezdes' => '08:00:00',
            'ido_vege' => '16:00:00'
        ]);

        // 3. Szabadság: De pont erre a napra kivesz egy szabadnapot
        \App\Models\Szabadsagok::insert([
            'dolgozo_id' => $dolgozo->id,
            'datum_kezdes' => $tesztDatum,
            'datum_vege' => $tesztDatum,
        ]);

        // 4. Végrehajtás: Lekérdezzük a szabad időpontokat
        $response = $this->json('POST', '/idopontfoglalas/szabad-idopontok', [
            'szolgaltatas_id' => $szolgaltatas->id,
            'dolgozo_id' => $dolgozo->id,
            'datum' => $tesztDatum
        ]);

        // 5. Ellenőrzés: Mivel szabadságon van, az 'idopontok' tömbnek teljesen üresnek kell lennie
        $response->assertStatus(200)
                 ->assertJson(['idopontok' => []]);
    }
}