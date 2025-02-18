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
        Schema::create('bracketmatches', function (Blueprint $table) {
            $table->id('match_id');
            $table->unsignedBigInteger('bracket_id');
            $table->foreign('bracket_id')->references('bracket_id')->on('brackets')->onDelete('cascade');

            $table->unsignedBigInteger('pool_id')->nullable();
            $table->foreign('pool_id')->references('pool_id')->on('bracketpools')->onDelete('cascade');

            $table->integer('match_number');

            $table->integer('round');
            
            $table->unsignedBigInteger('participant_1')->nullable();
            $table->foreign('participant_1')->references('participant_id')->on('participants')->onDelete('cascade');

            $table->unsignedBigInteger('participant_2')->nullable();
            $table->foreign('participant_2')->references('participant_id')->on('participants')->onDelete('cascade');

            $table->enum('status', ['Scheduled', 'Ongoing', 'Completed'])->default('Scheduled');
            $table->unsignedBigInteger('winner_id')->nullable();
            $table->foreign('winner_id')->references('participant_id')->on('participants')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bracketmatches');
    }
};
