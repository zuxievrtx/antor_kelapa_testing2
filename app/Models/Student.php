<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'class_id',
        'nis',
        'name',
        'gender',
        'email',
        'address',
        'hp',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    public function intership()
    {
        return $this->hasMany(Intership::class);
    }

    public function intershipRegistration()
    {
        return $this->hasMany(IntershipRegistration::class);
    }
}
