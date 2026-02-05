<?php

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
            'last_name' => 'Super',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN
        ]);

        User::create([
            'first_name' => 'Teacher',
            'last_name' => 'One',
            'email' => 'teacher@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::TEACHER
        ]);

        User::create([
            'first_name' => 'Student',
            'last_name' => 'One',
            'email' => 'student@test.com',
            'password' => Hash::make('password'),
            'role' => UserRole::STUDENT,
            'class_id' => 1
        ]);
    }
}

