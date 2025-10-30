<?php

namespace App\Models;

use App\Enums\MeetingStatus;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    //
    protected function casts(): array
    {
        return [
            'status' => MeetingStatus::class,
        ]; 
    }
}
