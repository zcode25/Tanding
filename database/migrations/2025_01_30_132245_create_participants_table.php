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
        Schema::create('participants', function (Blueprint $table) {
            $table->id('participant_id')->primary();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('age_id');
            $table->foreign('age_id')->references('age_id')->on('ages')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')->references('class_id')->on('matchclasses')->onUpdate('cascade')->onDelete('restrict');
            $table->string('gender');
            $table->json('athlete_name');
            $table->string('contingent_name');
            $table->integer('draw_number')->nullable();
            $table->boolean('is_drawn')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
