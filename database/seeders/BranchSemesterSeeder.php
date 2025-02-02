<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $branchSemesters = [];
        for ($branch_id = 1; $branch_id <= 4; $branch_id++) {
            for ($semester_id = 1; $semester_id <= 6; $semester_id++) {
                $branchSemesters[] = [
                    'branch_id' => $branch_id,
                    'semester_id' => $semester_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('branch_semester')->insert($branchSemesters);
    }
}
