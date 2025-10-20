<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'departament_id',
        'weekday',
        'start_time',
        'end_time',
        'duration_minutes'
    ];

     public function user()
    {
        return $this->belongsTo(Departament::class);
    }
}
