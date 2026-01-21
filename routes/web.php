<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IdopontfoglalasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
    use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SzolgaltatasController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/szolgaltatasok', [SzolgaltatasController::class, 'index'])->name('szolgaltatasok.index');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/idopontfoglalas', [IdopontfoglalasController::class, 'index'])
    ->name('idopontfoglalas.index');

Route::post('/idopontfoglalas/szabad-idopontok', [IdopontfoglalasController::class, 'SzabadIdopontok'])
    ->name('idopont.szabad');

Route::post('/idopontfoglalas/store', [IdopontfoglalasController::class, 'store'])
    ->middleware('auth')
    ->name('idopont.store');


Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
});
Route::delete('/profil/foglalas/{id}', [ProfileController::class, 'cancel'])
    ->middleware('auth')
    ->name('profile.cancel');
    Route::get('/profil/edit', [ProfileController::class, 'edit'])->middleware('auth')->name('profile.edit');
Route::post('/profil/update', [ProfileController::class, 'update'])->middleware('auth')->name('profile.update');
Route::put('/profil/jelszo', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

Route::get('/foglalhato-napok', [IdopontfoglalasController::class, 'foglalhatoNapok']);
Route::get('/dolgozok-szolgaltatas-alapjan', [IdopontfoglalasController::class, 'dolgozokSzolgaltatasAlapjan']);

Route::post('/foglalas/{id}/cancel', [ProfileController::class, 'cancel'])
    ->middleware('auth')
    ->name('profile.cancel');

Route::view('/kapcsolat', 'kapcsolat')->name('kapcsolat');

Route::get('/szolgaltatasok-kategoria-alapjan', [IdopontfoglalasController::class, 'szolgaltatasokKategoriaAlapjan']);

Route::middleware('guest:worker')->group(function () {
    Route::get('/dolgozo/belepes', [App\Http\Controllers\WorkerController::class, 'showLogin'])->name('worker.login');
    Route::post('/dolgozo/belepes', [App\Http\Controllers\WorkerController::class, 'login']);
});

// Csak bejelentkezett dolgozóknak (Dashboard + Funkciók)
Route::middleware('auth:worker')->group(function () {
    Route::get('/dolgozo/dashboard', [App\Http\Controllers\WorkerController::class, 'dashboard'])->name('worker.dashboard');
    Route::post('/dolgozo/kijelentkezes', [App\Http\Controllers\WorkerController::class, 'logout'])->name('worker.logout');
    
    // Műveletek
    Route::post('/dolgozo/foglalas/{id}/elfogadas', [App\Http\Controllers\WorkerController::class, 'updateStatus'])->name('worker.status.accept');
    Route::post('/dolgozo/szabadsag', [App\Http\Controllers\WorkerController::class, 'storeVacation'])->name('worker.vacation.store');
});

