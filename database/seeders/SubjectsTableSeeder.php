<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subjects')->insert([
            ['id' => 1, 'name' => 'Mathematics', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Science', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'History', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'English', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Computer Science', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
