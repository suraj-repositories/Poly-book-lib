<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'message', 'type', 'is_read', 'notifiable_id', 'notifiable_type'];

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }


}
