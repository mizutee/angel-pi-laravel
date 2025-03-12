<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        // Ensure the table is empty before seeding (optional)
        Schema::disableForeignKeyConstraints();
        DB::table('questions')->truncate();
        Schema::enableForeignKeyConstraints();

        // Define questions
        $questions = [
            ['id' => 1, 'question' => 'What are the key characteristics of Tangibles?', 'type_id' => 1],
            ['id' => 2, 'question' => 'How do you measure Reliability in services?', 'type_id' => 2],
            ['id' => 3, 'question' => 'What is the importance of Empathy in customer service?', 'type_id' => 3],
            ['id' => 4, 'question' => 'How can Assurance be provided to customers?', 'type_id' => 4],
            ['id' => 5, 'question' => 'What strategies can improve Responsiveness in service delivery?', 'type_id' => 5],
            ['id' => 6, 'question' => 'Can you provide examples of Tangibles in your service?', 'type_id' => 1],
            ['id' => 7, 'question' => 'What factors contribute to a customer’s perception of Reliability?', 'type_id' => 2],
            ['id' => 8, 'question' => 'How does Empathy affect customer satisfaction?', 'type_id' => 3],
            ['id' => 9, 'question' => 'What methods can be used to ensure Assurance in service quality?', 'type_id' => 4],
            ['id' => 10, 'question' => 'In what ways can a business enhance its Responsiveness to customer inquiries?', 'type_id' => 5],
        ];

        // Insert questions into the database
        DB::table('questions')->insert(array_map(function ($question) {
            return array_merge($question, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }, $questions));
    }
}
