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
        Schema::create('dolgozo', function (Blueprint $table) {
            $table->id();
            $table->string('nev', 100);
            $table->string('email', 150)->unique();
            $table->string('telefon', 20)->nullable();
            $table->string('jelszo', 255);
            $table->text('bio')->nullable();
            $table->string('kep', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dolgozo');
    }
};
