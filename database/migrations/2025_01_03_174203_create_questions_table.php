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
        Schema::create('questions', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key
            $table->timestamps(); // This creates created_at and updated_at columns
            $table->string('question'); // Column for the question text
            $table->unsignedBigInteger('type_id'); // Change to unsignedBigInteger for foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};