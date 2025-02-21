<?php

namespace App\Models;

use App\Services\Impl\FileServiceImpl;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'caption', 'video_url', 'hero_image', 'about_image'];

    public function getHeroImageURL(){
        if($this->hero_image){
            return url('storage/'.$this->hero_image);
        }
        return asset(config('settings.default_profile_image'));
    }
    public function getAboutImageURL(){
        if($this->about_image){
            return url('storage/'.$this->about_image);
        }
        return asset(config('settings.default_profile_image'));
    }

    public function getHeroImageSize(){
        $fileService = new FileServiceImpl();
        return $fileService->getSizeByPath($this->hero_image) ?? null;
    }
    public function getAboutImageSize(){
        $fileService = new FileServiceImpl();
        return $fileService->getSizeByPath($this->about_image) ?? null;
    }


}
