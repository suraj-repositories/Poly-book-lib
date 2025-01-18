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
            ['id' => 1, 'name' => '6 months', 'image' => null],
            ['id' => 2, 'name' => '6 months', 'image' => null],
            ['id' => 3, 'name' => '6 months', 'image' => null],
            ['id' => 4, 'name' => '6 months', 'image' => null],
            ['id' => 5, 'name' => '6 months', 'image' => null],
            ['id' => 6, 'name' => '6 months', 'image' => null],
        ];

        foreach ($semesters as $semester) {
            Semester::updateOrCreate(['id' => $semester['id']], $semester);
        }
    }
}
