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
        Schema::create('registerathletes', function (Blueprint $table) {
            $table->id('registerathlete_id');
            $table->unsignedBigInteger('register_id');
            $table->foreign('register_id')->references('register_id')->on('registers')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('athlete_id');
            $table->foreign('athlete_id')->references('athlete_id')->on('athletes')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registerathletes');
    }
};
