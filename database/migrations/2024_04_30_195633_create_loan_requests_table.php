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
        Schema::create('loan_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('income_variety');
            $table->string('job_type');
            $table->string('job_title');
            $table->string('second_job');
            $table->string('main_income');
            $table->string('other_income');
            $table->string('monthly_expenses');
            $table->string('salary_slip');
            $table->string('bank_statement');
            $table->string('assets');
            $table->string('loan_amount');
            $table->string('installments');
            $table->text('reason');
            $table->string('guarantor_name');
            $table->string('guarantor_national_code');
            $table->string('guarantor_birth_date');
            $table->string('guarantor_has_check');
            $table->enum('loan_request_status', ['confirmed', 'pending', 'rejected', 'cancel'])->default('pending');
            $table->text('des');
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
        Schema::dropIfExists('loan_requests');
    }
};
