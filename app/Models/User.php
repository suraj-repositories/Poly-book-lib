<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function hasRole($role){
        return ($this->role === $role) ? true:false;
    }

    public function getImageURL(){
        if($this->image){
            return url('storage/'.$this->image);
        }
        // return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={$this->name}";
        return asset(config('settings.default_profile_image'));
    }

    public function downloads(){
        return $this->hasMany(BookDownload::class, 'user_id', 'id');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function scopeOrderByDownloads($query)
    {
        return $query->withCount('downloads')->orderBy('downloads_count', 'desc');
    }

}
