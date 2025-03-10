<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $messages = [
            "Browse, download, and immerse yourself in a vast collection of books across all genres. Your next great read is just a click away—enjoy unlimited access anytime, anywhere.",
            "From timeless classics to the latest bestsellers, find and download the books you love with just a click. Dive into endless stories and expand your knowledge at your convenience!",
            "Whether you're a passionate reader or a curious learner, our vast digital library has something for everyone. Download, explore, and indulge in the world of books like never before!",
            "Unlock a universe of books at your fingertips! Download and enjoy novels, educational materials, and more, anytime you want, and experience the joy of limitless reading!",
            "Discover a world of knowledge and adventure with our extensive book collection. Download your favorite titles effortlessly and enjoy seamless reading anytime, anywhere, on any device!"
        ];

        $users = User::orderBy('id', 'asc')->take(5)->get();

        foreach($users as $index => $user){
            Testimonial::create([
                'user_id' => $user->id,
                'message' => $messages[$index],
                'order' => $index + 1,
            ]);
        }


    }
}
