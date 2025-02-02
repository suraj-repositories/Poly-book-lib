<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $branches = [
            ['name' => 'Computer Science', 'image' => 'cs.jpg'],
            ['name' => 'Mechanical Engineering', 'image' => 'me.jpg'],
            ['name' => 'Electrical Engineering', 'image' => 'ee.jpg'],
            ['name' => 'Civil Engineering', 'image' => 'ce.jpg'],
            ['name' => 'Electronics & Communication', 'image' => 'ec.jpg'],
            ['name' => 'Information Technology', 'image' => 'it.jpg'],
            ['name' => 'Biotechnology', 'image' => 'bt.jpg'],
            ['name' => 'Chemical Engineering', 'image' => 'che.jpg'],
            ['name' => 'Aeronautical Engineering', 'image' => 'ae.jpg'],
            ['name' => 'Automobile Engineering', 'image' => 'auto.jpg'],
            ['name' => 'Agricultural Engineering', 'image' => 'agri.jpg'],
            ['name' => 'Mining Engineering', 'image' => 'mining.jpg'],
            ['name' => 'Textile Engineering', 'image' => 'textile.jpg'],
            ['name' => 'Marine Engineering', 'image' => 'marine.jpg'],
            ['name' => 'Petroleum Engineering', 'image' => 'petro.jpg'],
            ['name' => 'Robotics Engineering', 'image' => 'robotics.jpg'],
            ['name' => 'Nano Technology', 'image' => 'nano.jpg'],
            ['name' => 'Biomedical Engineering', 'image' => 'biomed.jpg'],
            ['name' => 'Environmental Engineering', 'image' => 'env.jpg'],
            ['name' => 'Structural Engineering', 'image' => 'struct.jpg'],
        ];

        foreach ($branches as $branch) {
            Branch::updateOrCreate(['name' => $branch['name']], $branch);
        }
    }
}
