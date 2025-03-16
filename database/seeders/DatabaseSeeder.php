<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     UserTableSeeder::class,
        //     BranchSeeder::class,
        //     SemesterSeeder::class,
        //     BranchSemesterSeeder::class,
        //     BookSeeder::class,
        //     SettingsSeeder::class,
        //     FAQSeeder::class,
        //     TestimonialSeeder::class,
        //     PagesTableSeeder::class,
        // ]);

        $this->call([
            SettingsSeeder::class,
            FAQSeeder::class,
            TestimonialSeeder::class,
            PagesTableSeeder::class,
        ]);
    }
}
