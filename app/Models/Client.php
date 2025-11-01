<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
