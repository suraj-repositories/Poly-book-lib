<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $adminPages = config('pages.admin');

        $webPages = config('pages.web');

        foreach($adminPages as $route => $tokens){
            foreach($tokens as $token){
                Page::create([
                    'title' => $token,
                    'url' => route($route) ?? '',
                    'scope' => 'ADMIN'
                ]);
            }
        }
        foreach($webPages as $route => $tokens){
            foreach($tokens as $token){
                Page::create([
                    'title' => $token,
                    'url' => route($route) ?? '',
                    'scope' => 'ADMIN'
                ]);
            }
        }

    }
}
