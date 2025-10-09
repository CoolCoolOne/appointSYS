<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'departament_id',
    ];

     public function user()
    {
        return $this->belongsTo(Departament::class);
    }
}
