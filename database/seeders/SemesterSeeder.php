<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $semesters = [
            ['name' => 'Semester 1', 'image' => null],
            ['name' => 'Semester 2', 'image' => null],
            ['name' => 'Semester 3', 'image' => null],
            ['name' => 'Semester 4', 'image' => null],
            ['name' => 'Semester 5', 'image' => null],
            ['name' => 'Semester 6', 'image' => null],
        ];

        foreach ($semesters as $semester) {
            Semester::updateOrCreate(['name' => $semester['name']], $semester);
        }
    }
}
