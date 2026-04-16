<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('felhasznalo', function (Blueprint $table) {
            $table->id();
            $table->string('nev', 30);
            $table->string('email', 40);
            $table->string('telefonszam', 11)->nullable();
            $table->string('jelszo', 255);
            $table->dateTime('keszitve')->useCurrent();
            $table->boolean('velemenyt_irhat')->default(1);
            $table->boolean('foglalhat')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('felhasznalo');
    }
};
