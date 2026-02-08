<?php

namespace Database\Seeders;

use App\Enums\BriefTypeEnum;
use App\Models\Brief;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Sprint;
use Illuminate\Database\Seeder;

class BriefSeeder extends Seeder
{
    public function run(): void
    {
        $smith = User::where('email', 'smith@test.com')->first();
        $johnson = User::where('email', 'johnson@test.com')->first();
        $classA = SchoolClass::where('name', 'Class A')->first();
        $classB = SchoolClass::where('name', 'Class B')->first();
        $sprint1 = Sprint::where('name', 'Laravel Basics')->first();
        $sprint2 = Sprint::where('name', 'Advanced PHP')->first();

        Brief::create([
            'title' => 'Build Blog System',
            'description' => 'Complete blog with auth and CRUD.',
            'estimated_time' => 80,
            'type' => BriefTypeEnum::INDIVIDUAL,
            'sprint_id' => $sprint1->id,
            'class_id' => $classA->id,
            'teacher_id' => $smith->id,
            'is_published' => false // Mr. Smith, unpublished
        ]);

        Brief::create([
            'title' => 'Create API Project',
            'description' => 'Develop a RESTful API for a library system.',
            'estimated_time' => 120,
            'type' => BriefTypeEnum::GROUP,
            'sprint_id' => $sprint2->id,
            'class_id' => $classB->id,
            'teacher_id' => $johnson->id,
            'is_published' => false // Mrs. Johnson, unpublished
        ]);
    }
}
