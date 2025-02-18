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
        Schema::create('athletes', function (Blueprint $table) {
            $table->id('athlete_id')->primary();
            $table->unsignedBigInteger('contingent_id');
            $table->foreign('contingent_id')->references('contingent_id')->on('contingents')->onUpdate('cascade')->onDelete('restrict');
            $table->string('athlete_name');
            $table->string('athlete_gender');
            $table->date('date_birth');
            $table->string('place_birth');
            $table->string('nik');
            $table->integer('weight');
            $table->integer('height');
            $table->string('school_name');
            $table->string('athlete_photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};
