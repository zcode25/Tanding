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
        Schema::create('registers', function (Blueprint $table) {
            $table->id('register_id')->primary();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('age_id');
            $table->foreign('age_id')->references('age_id')->on('ages')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('class_id')->nullable();
            $table->foreign('class_id')->references('class_id')->on('matchclasses')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('contingent_id');
            $table->foreign('contingent_id')->references('contingent_id')->on('contingents')->onUpdate('cascade')->onDelete('restrict');
            $table->string('gender');
            $table->integer('price');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
