<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
     protected $fillable = [
        'name',
        'short_name',
    ];

    public function classRooms()
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function teacherPositions()
    {
        return $this->hasMany(TeacherPosition::class);
    }
}
