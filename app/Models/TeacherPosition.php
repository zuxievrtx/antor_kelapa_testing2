<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherPosition extends Model
{
    
    protected $fillable = [
        'teacher_id',
        'user_id',
        'position_id',
        'major_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
