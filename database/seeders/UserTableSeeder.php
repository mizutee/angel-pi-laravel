<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default password for all users
        $defaultPassword = '$2y$12$qzfzPAJW/rVEwCgkQ7rsZ.j.5nY58KnrN740LQssGu1qz7Uf3vodW';

        // Insert the admin user (only 1 admin)
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => $defaultPassword,
            'role' => 'admin',
            'phone_number' => '081234567890',
            'address' => 'Admin Office',
            'dob' => '1990-01-01',
            'gender' => 'male',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'subject_id' => null,
        ]);

        // Insert multiple teacher users
        $teachers = [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'gender' => 'male',
                'phone_number' => '081234567891',
                'address' => 'Teacher Street No.1',
                'dob' => '1985-06-15',
                'subject_id' => 1, // Example subject ID
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@example.com',
                'gender' => 'female',
                'phone_number' => '081234567892',
                'address' => 'Teacher Street No.2',
                'dob' => '1990-09-25',
                'subject_id' => 2,
            ]
        ];

        foreach ($teachers as $teacher) {
            DB::table('users')->insert(array_merge($teacher, [
                'email_verified_at' => now(),
                'password' => $defaultPassword,
                'role' => 'teacher',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Insert multiple student users
        $students = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'gender' => 'female',
                'phone_number' => '081234567893',
                'address' => 'Student Dorm A',
                'dob' => '2002-04-10',
                'subject_id' => 1, // Example subject ID
            ],
            [
                'name' => 'Bob Williams',
                'email' => 'bob@example.com',
                'gender' => 'male',
                'phone_number' => '081234567894',
                'address' => 'Student Dorm B',
                'dob' => '2001-07-22',
                'subject_id' => 2,
            ]
        ];

        foreach ($students as $student) {
            DB::table('users')->insert(array_merge($student, [
                'email_verified_at' => now(),
                'password' => $defaultPassword,
                'role' => 'student',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
