<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasOne;
// use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Slot extends Model
{
    protected $fillable = [
        'slot_datetime',
        'is_occupied',
        'unit_id',
    ];
    //
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function slot()
    {
        return $this->hasOne(Meeting::class);
    }

    // public function meeting(): HasOneThrough
    // {
    //     return $this->hasOneThrough(Slot::class, Unit::class);
    // }
}
