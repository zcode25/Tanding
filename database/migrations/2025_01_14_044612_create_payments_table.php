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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id')->primary();
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('paymentmethod_id');
            $table->foreign('paymentmethod_id')->references('paymentmethod_id')->on('paymentmethods')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('contingent_id');
            $table->foreign('contingent_id')->references('contingent_id')->on('contingents')->onUpdate('cascade')->onDelete('restrict');
            $table->string('payment_proof');
            $table->integer('amount');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
