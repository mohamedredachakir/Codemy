<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sprint;

class SprintSeeder extends Seeder
{
    public function run(): void
    {
       Sprint::create([
        'name' => 'Laravel Basics',
        'duration' => 14,
        'order' => 1
      ]);

       Sprint::create([
        'name' => 'Advanced PHP',
        'duration' => 21,
        'order' => 2
      ]);
    }
}
