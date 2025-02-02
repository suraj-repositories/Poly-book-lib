<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = File::first();
        $fileId = $file ? $file->id : null;
        //
        for ($i = 1; $i <= 24; $i++) {
            DB::table('books')->insert([
                'branch_semester_id' => $i,
                'file_id' => $fileId,
                'title' => 'Book ' . $i,
                'author' => 'Author ' . $i,
                'cover_image' => 'cover' . $i . '.jpg',
                'pages' => rand(100, 500),
                'description' => 'Description for Book ' . $i,
                'price' => rand(100, 1000) / 10,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
