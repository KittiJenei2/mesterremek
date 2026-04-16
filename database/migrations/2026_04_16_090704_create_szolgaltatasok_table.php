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
        Schema::create('szolgaltatasok', function (Blueprint $table) {
            $table->id();
            $table->string('nev', 40);
            $table->integer('ar');
            $table->integer('idotartam');
            $table->integer('lehetosegek_id');
            $table->text('leiras')->nullable();

            $table->foreign('lehetosegek_id')->references('id')->on('lehetosegek')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('szolgaltatasok');
    }
};
