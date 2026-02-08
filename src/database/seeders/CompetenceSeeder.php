<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competence;

class CompetenceSeeder extends Seeder
{
    public function run(): void
    {
        Competence::create(['code' => 'OOP', 'label' => 'Object Oriented Programming']);
        Competence::create(['code' => 'MVC', 'label' => 'Model View Controller']);
        Competence::create(['code' => 'Blade', 'label' => 'Blade Templating']);
        Competence::create(['code' => 'Routing', 'label' => 'Laravel Routing']);
    }
}
