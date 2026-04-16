<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Felhasznalo;
use App\Models\Dolgozo;
use App\Models\Szolgaltatas;
use App\Models\Idopontfoglalas;
use Illuminate\Support\Facades\Mail;
use App\Mail\FoglalasLemondva;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;

    public function test_felhasznalo_tudja_modositani_a_profil_adatait()
    {
        /** @var \App\Models\Felhasznalo $user */
        $user = Felhasznalo::factory()->create([
            'nev' => 'Régi Név',
            'email' => 'regi@email.hu',
            'telefonszam' => '06301111111'
        ]);
        $this->actingAs($user);

        $response = $this->post('/profil/update', [
            'nev' => 'Új Név Teszt',
            'email' => 'ujemail@teszt.hu',
            'telefonszam' => '06309998877'
        ]);

        $response->assertRedirect(route('profile.index'))
                 ->assertSessionHas('success', 'Adatok sikeresen módosítva!');

        $this->assertDatabaseHas('felhasznalo', [
            'id' => $user->id,
            'nev' => 'Új Név Teszt',
            'email' => 'ujemail@teszt.hu',
            'telefonszam' => '06309998877'
        ]);
    }

    public function test_velemeny_iras_nem_lehetseges_ha_le_van_tiltva()
    {
        /** @var \App\Models\Felhasznalo $user */
        $user = Felhasznalo::factory()->create(['velemenyt_irhat' => 0]);
        $this->actingAs($user);

        $response = $this->post('/profil/velemeny', [
            'idopont_id' => 1,
            'ertekeles' => 5,
            'velemeny' => 'Nagyon jó volt!'
        ]);

        $response->assertSessionHas('error', 'Fiókodhoz a véleményírás le lett tiltva az adminisztrátor által!');
    }

    public function test_jovobeli_foglalas_lemondasa_sikeres_es_emailt_kuld()
    {
        Mail::fake(); 

        /** @var \App\Models\Felhasznalo $user */
        $user = Felhasznalo::factory()->create();
        $dolgozo = Dolgozo::factory()->create();
        $szolgaltatas = Szolgaltatas::factory()->create();

        $this->actingAs($user);

        $foglalas = Idopontfoglalas::create([
            'felhasznalo_id' => $user->id,
            'dolgozo_id' => $dolgozo->id,
            'szolgaltatasok_id' => $szolgaltatas->id,
            'datum' => now()->addDays(5)->format('Y-m-d'),
            'ido_kezdes' => '10:00:00',
            'ido_vege' => '11:00:00',
            'statuszok_id' => 1,
        ]);

        $response = $this->delete('/profil/foglalas/' . $foglalas->id);

        $response->assertStatus(200)
                 ->assertJson(['uzenet' => 'A foglalás sikeresen törölve.']);

        $this->assertDatabaseMissing('idopontfoglalas', [
            'id' => $foglalas->id
        ]);

        Mail::assertSent(FoglalasLemondva::class);
    }
}