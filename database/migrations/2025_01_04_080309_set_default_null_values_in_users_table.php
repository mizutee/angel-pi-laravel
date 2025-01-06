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
            // Set multiple columns to nullable
            $table->string('phone_number')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('dob')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->unsignedBigInteger('subject_id')->nullable()->change();
            // Add more columns as needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the changes if needed
            $table->string('phone_number')->nullable(false)->change();
            $table->string('gender')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('dob')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->unsignedBigInteger('subject_id')->nullable(false)->change();
        });
    }
};
