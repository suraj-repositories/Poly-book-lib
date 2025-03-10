<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'order', 'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
