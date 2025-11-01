<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Slot extends Model
{
    //
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // public function meeting(): HasOneThrough
    // {
    //     return $this->hasOneThrough(Slot::class, Unit::class);
    // }
}
