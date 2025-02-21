<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Services\FileService;
use Illuminate\Http\Request;

class HeroSectionSettingController extends Controller
{
    //
    private $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    public function index()
    {
        $heroSection = HeroSection::first();
        return view('admin.settings.hero_section', compact('heroSection'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|max:100',
            'caption' => 'required|max:256',
            'video_url' => 'required|url|max:256',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $heroImagePath = null;
        if ($request->has('hero_image')) {
            $heroImagePath = $this->fileService->uploadFile($request->hero_image, 'website');
        }
        $aboutImagePath = null;
        if ($request->has('about_image')) {
            $aboutImagePath = $this->fileService->uploadFile($request->about_image, 'website');
        }

        $heroSection = HeroSection::first();
        if ($heroSection) {
            $heroSection->update([
                'title' => $validated['title'] ?? $heroSection->title,
                'caption' => $validated['caption'] ?? $heroSection->caption,
                'video_url' => $validated['video_url'] ?? $heroSection->video_url,
                'hero_image' => $heroImagePath ?? $heroSection->hero_image,
                'about_image' => $aboutImagePath ?? $heroSection->about_image,
            ]);
        } else {
            HeroSection::create([
                'title' => $validated['title'],
                'caption' => $validated['caption'],
                'video_url' => $validated['video_url'],
                'hero_image' => $heroImagePath,
                'about_image' => $aboutImagePath,
            ]);
        }

        return back()->with('success', 'Hero Section Updated Successfully!');
    }
}
