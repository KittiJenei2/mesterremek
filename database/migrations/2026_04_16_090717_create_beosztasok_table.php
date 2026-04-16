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
        Schema::create('beosztasok', function (Blueprint $table) {
            $table->id();
            $table->integer('dolgozo_id');
            $table->integer('napok_id');
            $table->time('ido_kezdes');
            $table->time('ido_vege');

            $table->foreign('dolgozo_id')->references('id')->on('dolgozo')->onDelete('cascade');
            $table->foreign('napok_id')->references('id')->on('napok')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beosztasok');
    }
};
