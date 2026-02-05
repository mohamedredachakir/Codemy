<?php

namespace Database\Seeders;

use App\Enums\BriefTypeEnum;
use App\Models\Brief;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BriefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brief::create([
        'title' => 'Create REST API',
        'description' => 'Build Laravel API',
        'estimated_duration' => 5,
        'type' => BriefTypeEnum::INDIVIDUAL,
        'sprint_id' => 1,
        'class_id' => 1,
        'teacher_id' => 2
         ]);

    }
}
