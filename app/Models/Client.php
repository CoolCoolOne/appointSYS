<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    protected $fillable = [
        'phone',
        'name',
        'email',
        'name_addition',
        'email_addition',
    ];
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
