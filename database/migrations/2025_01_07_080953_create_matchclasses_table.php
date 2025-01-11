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
        Schema::create('matchclasses', function (Blueprint $table) {
            $table->id('class_id')->primary();
            $table->unsignedBigInteger('age_id');
            $table->foreign('age_id')->references('age_id')->on('ages')->onUpdate('cascade')->onDelete('restrict');
            $table->string('class_name');
            $table->string('class_gender');
            $table->integer('class_min');
            $table->integer('class_max');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchclasses');
    }
};
