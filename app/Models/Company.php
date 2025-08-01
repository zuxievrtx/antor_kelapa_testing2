<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{    
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'website',
        'leader',
    ];
}
