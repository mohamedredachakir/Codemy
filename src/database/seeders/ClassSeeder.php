<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        SchoolClass::create(['name' => 'Class A']);
        SchoolClass::create(['name' => 'Class B']);
    }
}
