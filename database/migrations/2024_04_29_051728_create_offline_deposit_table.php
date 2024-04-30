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
        Schema::create('offline_deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('origin_card_number');
            $table->string('destination_card_number');
            $table->string('amount');
            $table->string('deposit_time');
            $table->string('tracking_number');
            $table->string('desc')->nullable();
            $table->enum('transfer_status', ['confirmed', 'pending', 'rejected'])->default('pending');
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offline_deposit');
    }
};
