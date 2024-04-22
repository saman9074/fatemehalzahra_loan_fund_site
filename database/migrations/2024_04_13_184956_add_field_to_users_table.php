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
        Schema::table('users', function (Blueprint $table) {
            $table->string('family')->nullable()->after('name');
            $table->string('national_code')->nullable()->after('family');
            $table->string('post_code')->nullable()->after('national_code');
            $table->text('home_address')->nullable()->after('post_code');
            $table->string('jobs')->nullable()->after('home_address');
            $table->text('work_address')->nullable()->after('jobs');
            $table->string('username')->unique()->after('email');
           // $table->string('mobile')->unique()->after('username');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
