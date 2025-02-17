<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TypesTableSeeder extends Seeder
{
    public function run()
    {
        // Ensure the table is empty before seeding (optional)
        Schema::disableForeignKeyConstraints();
        DB::table('types')->truncate();
        Schema::enableForeignKeyConstraints();

        // Define types
        $types = [
            ['id' => 1, 'name' => 'Tangibles'],
            ['id' => 2, 'name' => 'Reliability'],
            ['id' => 3, 'name' => 'Empathy'],
            ['id' => 4, 'name' => 'Assurance'],
            ['id' => 5, 'name' => 'Responsiveness'],
        ];

        // Insert types into the database
        DB::table('types')->insert(array_map(function ($type) {
            return array_merge($type, [
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }, $types));
    }
}