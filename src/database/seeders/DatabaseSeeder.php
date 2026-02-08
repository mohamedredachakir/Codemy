<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use App\Models\SchoolClass;
use App\Models\Sprint;
use App\Models\Competence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            ClassSeeder::class,
            UserSeeder::class,
            SprintSeeder::class,
            CompetenceSeeder::class,
        ]);

        $classA = SchoolClass::where('name', 'Class A')->first();
        $classB = SchoolClass::where('name', 'Class B')->first();
        $smith = User::where('email', 'smith@test.com')->first();
        $johnson = User::where('email', 'johnson@test.com')->first();
        $sprint1 = Sprint::where('name', 'Laravel Basics')->first();
        $sprint2 = Sprint::where('name', 'Advanced PHP')->first();
        $competences = Competence::all();

        // Mr. Smith -> Class A
        $classA->teachers()->syncWithoutDetaching([$smith->id]);
        // Mrs. Johnson -> Class B
        $classB->teachers()->syncWithoutDetaching([$johnson->id]);

        // Sprint 1 -> Class A
        $classA->sprints()->syncWithoutDetaching([$sprint1->id]);
        // Sprint 2 -> Class B
        $classB->sprints()->syncWithoutDetaching([$sprint2->id]);

        // Competences mapping
        // Sprint 1 gets MVC, Blade, Routing
        $sprint1->competences()->syncWithoutDetaching([2, 3, 4]);
        // Sprint 2 gets OOP, MVC
        $sprint2->competences()->syncWithoutDetaching([1, 2]);

        // Finally create the briefs via BriefSeeder or manually here for precision
        $this->call(BriefSeeder::class);
    }
}
