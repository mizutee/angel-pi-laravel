<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('answers', function (Blueprint $table) {
            // Rename existing column
            $table->renameColumn('answer_value', 'experience_value');

            // Add new column after experience_value
            $table->integer('expectation_value')->nullable()->after('experience_value');
        });
    }

    public function down() {
        Schema::table('answers', function (Blueprint $table) {
            // Revert the column name change
            $table->renameColumn('experience_value', 'answer_value');

            // Drop the newly added column
            $table->dropColumn('expectation_value');
        });
    }
};
