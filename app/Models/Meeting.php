<?php

namespace App\Models;

use App\Enums\MeetingStatus;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Meeting extends Model
{
    protected $fillable = [
        'unit_id',
        'slot_id',
        'client_id',
        'booked_datetime',
        'status',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }


    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // public function slot(): HasOneThrough
    // {
    //     return $this->hasOneThrough(Meeting::class, Unit::class);
    // }

    protected $casts = [
        'status' => MeetingStatus::class,
    ];
}
