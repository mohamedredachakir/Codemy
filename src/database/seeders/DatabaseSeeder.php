<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use UserSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $class = SchoolClass::factory()->create();

        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Test',
            'last_name'  => 'User',
            'email'      => 'test@example.com',
            'password'   => bcrypt('password'),
            'role'       => 'student',
            'class_id'   => $class->id,
        ]);


        //  $this->call([
        //     ClassSeeder::class,
        //     UserSeeder::class,
        //     SprintSeeder::class,
        //     CompetenceSeeder::class,
        //     BriefSeeder::class,
        //  ]);



    }
}
