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
        Schema::create('matchtgrs', function (Blueprint $table) {
            $table->id('matchtgr_id')->primary();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('competition_id');
            $table->foreign('competition_id')->references('competition_id')->on('competitions')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('participant_id')->nullable();
            $table->foreign('participant_id')->references('participant_id')->on('participants')->onDelete('cascade');
            $table->string('value')->nullable();
            $table->string('champion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchtgrs');
    }
};
