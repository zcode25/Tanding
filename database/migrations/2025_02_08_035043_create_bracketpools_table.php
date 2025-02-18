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
        Schema::create('bracketpools', function (Blueprint $table) {
            $table->id('pool_id');
            $table->unsignedBigInteger('bracket_id');
            $table->foreign('bracket_id')->references('bracket_id')->on('brackets')->onDelete('cascade');
            $table->integer('pool_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bracketpools');
    }
};
