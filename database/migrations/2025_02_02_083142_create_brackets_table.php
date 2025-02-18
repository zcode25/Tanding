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
        Schema::create('brackets', function (Blueprint $table) {
            $table->id('bracket_id');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('competition_id');
            $table->foreign('competition_id')->references('competition_id')->on('competitions')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')->references('class_id')->on('matchclasses')->onDelete('set null');
            $table->enum('format', ['Full', 'Pool']);
            $table->integer('total_participants');
            $table->integer('total_pools')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brackets');
    }
};
