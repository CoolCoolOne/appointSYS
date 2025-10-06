<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resourse extends Model
{
    //
    protected $fillable = [
        'name',
        'user_id',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
