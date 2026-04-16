<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Felhasznalo;

class AuthTest extends TestCase
{
    use DatabaseTransactions; // Itt is kötelező, hogy ne szemeteljük tele az élő adatbázist!

    public function test_megjelenik_a_bejelentkezes_oldal()
    {
        // Végrehajtás: A felhasználó megnyitja a /login útvonalat
        $response = $this->get('/login');

        // Ellenőrzés: Sikeres a betöltés (200-as státuszkód)
        $response->assertStatus(200);
    }

    public function test_felhasznalo_tud_bejelentkezni_helyes_adatokkal()
    {
        // 1. Előkészítés: Létrehozunk egy usert, akinek tudjuk a jelszavát
        $user = Felhasznalo::factory()->create([
            'jelszo' => bcrypt('Titkos123!') 
        ]);

        // 2. Végrehajtás: Elküldjük a POST kérést
        // FIGYELEM: Ha a te HTML formodban a jelszó mező 'name' attribútuma 'jelszo',
        // akkor a 'password' szót cseréld ki 'jelszo'-ra a lenti tömbben!
        $response = $this->post('/login', [
            'email' => $user->email,
            'jelszo' => 'Titkos123!', 
        ]);

        // 3. Ellenőrzés: Bejelentkezett állapotban van-e a rendszerben
        $this->assertAuthenticatedAs($user);
        
        // Ellenőrizzük, hogy átirányít-e a főoldalra (vagy ahova a login után kell mennie)
        $response->assertRedirect('/idopontfoglalas'); 
    }

    public function test_mukodik_a_regisztracio_es_menti_az_adatokat()
    {
        $response = $this->post('/register', [
            'nev' => 'Teszt Elek',
            'email' => 'teszt@elek.hu',
            'telefonszam' => '06301234567',
            'jelszo' => 'Titkos123!',          
            'password_confirmation' => 'Titkos123!', 
        ]);

        $this->assertDatabaseHas('felhasznalo', [
            'email' => 'teszt@elek.hu'
        ]);
        
        $response->assertRedirect('/idopontfoglalas'); 
    }

    public function test_felhasznalo_nem_tud_bejelentkezni_hibas_jelszoval()
    {
        $user = Felhasznalo::factory()->create([
            'jelszo' => bcrypt('Titkos123!')
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'jelszo' => 'RosszJelszoGarantaltan',
        ]);

        // Ellenőrzés: A felhasználó vendég maradt (nem jelentkezett be)
        $this->assertGuest();
    }

    public function test_telefon_hibas_formatum_eseten_nem_enged_tovabb()
    {
        $response = $this->post('/register', [
            'nev' => 'Teszt Elek',
            'email' => 'teszt2@elek.hu',
            'telefonszam' => 'ez_nem_egy_telefonszam',
            'jelszo' => 'Titkos123!',
            'password_confirmation' => 'Titkos123!',
        ]);

        $response->assertSessionHasErrors(['telefonszam']);
    }

    public function test_jelszo_hibas_formatum_eseten_nem_enged_tovabb()
    {
        $response = $this->post('/register', [
            'nev' => 'Teszt Elek',
            'email' => 'teszt3@elek.hu',
            'telefonszam' => '06301234567',
            'jelszo' => '123',
            'password_confirmation' => '123',
        ]);

        $response->assertSessionHasErrors(['jelszo']);
    }

    public function test_felhasznalo_Ki_tud_jelentkezni()
    {
        /** @var \App\Models\Felhasznalo $user */
        $user = Felhasznalo::factory()->create();
        
        // Bejelentkeztetjük a teszt erejéig
        $this->actingAs($user); 

        // Rányom a kijelentkezés gombra (POST kérés)
        $response = $this->post('/logout');

        // Ellenőrzés: Újra vendég (Guest) lett
        $this->assertGuest();
        $response->assertRedirect('/');
    }
}