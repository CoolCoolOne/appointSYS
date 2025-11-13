<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    
    protected $fillable = [
        'phone',
        'name',
        'email',
        'name_additional',
        'email_additional',
    ];
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
