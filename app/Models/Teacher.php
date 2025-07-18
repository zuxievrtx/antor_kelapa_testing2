<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    
    protected $fillable = [
        'nip',
        'name',
        'email',
    ];

    public function positions()
    {
        return $this->hasMany(TeacherPosition::class);
    }
}
