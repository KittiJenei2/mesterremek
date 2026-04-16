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
        Schema::create('velemenyek', function (Blueprint $table) {
            $table->id();
            $table->integer('felhasznalo_id');
            $table->integer('idopont_id');
            $table->integer('ertekeles');
            $table->text('velemeny')->nullable();

            $table->foreign('felhasznalo_id')->references('id')->on('felhasznalo')->onDelete('cascade');
            $table->foreign('idopont_id')->references('id')->on('idopontfoglalas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('velemenyek');
    }
};
