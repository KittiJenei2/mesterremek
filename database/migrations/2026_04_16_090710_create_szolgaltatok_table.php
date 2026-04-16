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
        Schema::create('szolgaltatok', function (Blueprint $table) {
            $table->id();
            $table->integer('dolgozo_id');
            $table->integer('lehetosegek_id');

            $table->foreign('dolgozo_id')->references('id')->on('dolgozo')->onDelete('cascade');
            $table->foreign('lehetosegek_id')->references('id')->on('lehetosegek')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('szolgaltatok');
    }
};
