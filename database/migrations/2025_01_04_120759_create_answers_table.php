<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade'); // Foreign key to questions table
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); // Foreign key to students table
            $table->foreignId('teacher_id')->constrained('users')->onDelete('cascade'); // Foreign key to teachers table
            $table->integer('answer_value'); // The answer value (e.g., 1 to 5)
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('answers');
    }
}