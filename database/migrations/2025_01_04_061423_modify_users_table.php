<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the old subject column
            $table->dropColumn('subject');

            // Add the new subject_id column
            $table->unsignedBigInteger('subject_id')->nullable(); // Make it nullable if not all users have a subject

            // Add foreign key constraint
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the changes
            $table->string('subject'); // Add back the old subject column
            $table->dropForeign(['subject_id']); // Drop the foreign key constraint
            $table->dropColumn('subject_id'); // Drop the subject_id column
        });
    }
}
