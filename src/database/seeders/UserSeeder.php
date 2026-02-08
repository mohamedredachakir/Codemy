<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Codemy',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN
        ]);

       
        $smith = User::create([
            'first_name' => 'Mr.',
            'last_name' => 'Smith',
            'email' => 'smith@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::TEACHER
        ]);

        $johnson = User::create([
            'first_name' => 'Mrs.',
            'last_name' => 'Johnson',
            'email' => 'johnson@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::TEACHER
        ]);

        User::create([
            'first_name' => 'Alice',
            'last_name' => 'Student',
            'email' => 'alice@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::STUDENT,
            'class_id' => 1// Class A
        ]);

        User::create([
            'first_name' => 'Bob',
            'last_name' => 'Student',
            'email' => 'bob@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::STUDENT,
            'class_id' => 1 // Class A
        ]);

        User::create([
            'first_name' => 'Charlie',
            'last_name' => 'Student',
            'email' => 'charlie@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::STUDENT,
            'class_id' => 2 // Class B
        ]);
    }
}
