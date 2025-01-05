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
        Schema::create('information', function (Blueprint $table) {
            $table->id('infomation_id')->primary();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')->onUpdate('cascade')->onDelete('restrict');
            $table->string('title');
            $table->text('description');
            $table->date('open_reg');
            $table->date('close_reg');
            $table->date('start_match');
            $table->date('end_match');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
