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
        Schema::create('idopontfoglalas', function (Blueprint $table) {
            $table->id();
            $table->integer('felhasznalo_id');
            $table->integer('dolgozo_id');
            $table->integer('szolgaltatasok_id');
            $table->date('datum');
            $table->time('ido_kezdes');
            $table->time('ido_vege');
            $table->integer('statuszok_id')->default(1);
            $table->dateTime('foglalas_idopontja')->useCurrent();

            $table->foreign('felhasznalo_id')->references('id')->on('felhasznalo')->onDelete('cascade');
            $table->foreign('dolgozo_id')->references('id')->on('dolgozo')->onDelete('cascade');
            $table->foreign('szolgaltatasok_id')->references('id')->on('szolgaltatasok')->onDelete('cascade');
            $table->foreign('statuszok_id')->references('id')->on('statuszok')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('idopontfoglalas');
    }
};
