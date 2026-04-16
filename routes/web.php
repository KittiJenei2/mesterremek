<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TermekController;
use App\Http\Controllers\IdopontfoglalasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SzolgaltatasController;
use App\Http\Controllers\WorkerController;

// ============================================================
// Publikus oldalak
// ============================================================
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/szolgaltatasok', [SzolgaltatasController::class, 'index'])->name('szolgaltatasok.index');
Route::get('/kollegaink', [HomeController::class, 'staff'])->name('dolgozok.index');
Route::get('/termekek', [TermekController::class, 'index'])->name('termekek.index');
Route::view('/kapcsolat', 'kapcsolat')->name('kapcsolat');
Route::get('/idopontfoglalas', [IdopontfoglalasController::class, 'index'])->name('idopontfoglalas.index');

// ============================================================
// Auth (vendég → bejelentkezés / regisztráció)
// ============================================================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ============================================================
// Időpontfoglalás AJAX végpontok (publikus)
// ============================================================
Route::get('/szolgaltatasok-kategoria-alapjan', [IdopontfoglalasController::class, 'szolgaltatasokKategoriaAlapjan']);
Route::get('/dolgozok-szolgaltatas-alapjan', [IdopontfoglalasController::class, 'dolgozokSzolgaltatasAlapjan']);
Route::get('/foglalhato-napok', [IdopontfoglalasController::class, 'foglalhatoNapok']);
Route::post('/idopontfoglalas/szabad-idopontok', [IdopontfoglalasController::class, 'SzabadIdopontok'])->name('idopont.szabad');

// ============================================================
// Bejelentkezett felhasználó (auth middleware)
// ============================================================
Route::middleware('auth')->group(function () {
    // Foglalás mentése
    Route::post('/idopontfoglalas/store', [IdopontfoglalasController::class, 'store'])->name('idopont.store');

    // Profil
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profil/velemeny', [ProfileController::class, 'storeFeedback'])->name('profile.feedback.store');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profil/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/jelszo', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Foglalás kezelés
    Route::post('/foglalas/{id}/cancel', [ProfileController::class, 'cancel'])->name('profile.cancel');
    Route::put('/profil/foglalas/{id}/modositas', [ProfileController::class, 'updateTime'])->name('profile.appointmen.update');
});

// ============================================================
// Dolgozó (worker guard)
// ============================================================
Route::middleware('auth:worker')->group(function () {
    Route::get('/dolgozo/dashboard', [WorkerController::class, 'dashboard'])->name('worker.dashboard');
    Route::put('/dolgozo/szabadsag/{id}', [WorkerController::class, 'updateVacation'])->name('worker.vacation.update');
    Route::post('/dolgozo/kijelentkezes', [WorkerController::class, 'logout'])->name('worker.logout');
    Route::post('/dolgozo/foglalas/{id}/elfogadas', [WorkerController::class, 'updateStatus'])->name('worker.status.accept');
    Route::post('/dolgozo/szabadsag', [WorkerController::class, 'storeVacation'])->name('worker.vacation.store');
    Route::delete('/dolgozo/szabadsag/{id}', [WorkerController::class, 'destroyVacation'])->name('worker.vacation.destroy');
});

Route::post('/kapcsolat/kuldes', [HomeController::class, 'sendContactEmail'])->name('kapcsolat.send');