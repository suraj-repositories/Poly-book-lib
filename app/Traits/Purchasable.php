<?php

namespace App\Traits;

use App\Models\Transaction;

trait Purchasable
{
    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'purchasable');
    }
}
