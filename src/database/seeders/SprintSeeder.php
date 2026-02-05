<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sprint;

class SprintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Sprint::create([
        'name' => 'Sprint 1',
        'duration' => 15,
        'order' => 1
      ]);

    }
}
