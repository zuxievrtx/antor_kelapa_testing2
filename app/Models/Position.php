<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = [
        'slug',
        'title',
    ];

    public function teacherPositions()
    {
        return $this->hasMany(TeacherPosition::class);
    }
}
