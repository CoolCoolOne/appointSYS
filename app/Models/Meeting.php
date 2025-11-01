<?php

namespace App\Models;

use App\Enums\MeetingStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Meeting extends Model
{
    //
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // public function slot(): HasOneThrough
    // {
    //     return $this->hasOneThrough(Meeting::class, Unit::class);
    // }

    protected function casts(): array
    {
        return [
            'status' => MeetingStatus::class,
        ]; 
    }
}
