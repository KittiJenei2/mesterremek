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
        Schema::create('szabadsagok', function (Blueprint $table) {
            $table->id();
            $table->integer('dolgozo_id');
            $table->date('datum_kezdes');
            $table->date('datum_vege');

            $table->foreign('dolgozo_id')->references('id')->on('dolgozo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('szabadsagok');
    }
};
