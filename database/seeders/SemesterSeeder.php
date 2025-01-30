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
            ['id' => 1, 'title' => 'Semester 1', 'sub_title' => '6 months', 'image' => null],
            ['id' => 2, 'title' => 'Semester 2', 'sub_title' => '6 months', 'image' => null],
            ['id' => 3, 'title' => 'Semester 3', 'sub_title' => '6 months', 'image' => null],
            ['id' => 4, 'title' => 'Semester 4', 'sub_title' => '6 months', 'image' => null],
            ['id' => 5, 'title' => 'Semester 5', 'sub_title' => '6 months', 'image' => null],
            ['id' => 6, 'title' => 'Semester 6', 'sub_title' => '6 months', 'image' => null],
        ];

        foreach ($semesters as $semester) {
            Semester::updateOrCreate(['id' => $semester['id']], $semester);
        }
    }
}
