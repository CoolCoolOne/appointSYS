<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDomain extends Model
{
    protected $fillable = [
        'note',
        'domain_url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
