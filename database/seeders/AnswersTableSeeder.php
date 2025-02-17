<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AnswersTableSeeder extends Seeder
{
    public function run()
    {
        // Ensure the table is empty before seeding (optional)
        Schema::disableForeignKeyConstraints();
        DB::table('answers')->truncate();
        Schema::enableForeignKeyConstraints();

        // Define students, teachers, and questions
        $students = [1, 2];
        $teachers = [1, 2]; // Adjust this based on actual teacher IDs in your database
        $questions = range(1, 10); // Questions from 1 to 10

        $data = [];
        foreach ($students as $student) {
            foreach ($teachers as $teacher) {
                foreach ($questions as $question) {
                    $data[] = [
                        'question_id' => $question,
                        'student_id' => $student,
                        'teacher_id' => $teacher,
                        'experience_value' => rand(1, 5),
                        'expectation_value' => rand(1, 5),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        // Insert into the database
        DB::table('answers')->insert($data);
    }
}
