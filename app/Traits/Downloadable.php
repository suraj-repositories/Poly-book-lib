<?php

namespace App\Traits;

use App\Models\Download;

trait Downloadable
{
    public function downloads()
    {
        return $this->morphMany(Download::class, 'downloadable');
    }
}
