<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intership extends Model
{
    
    protected $fillable = [
        'student_id',
        'company_id',
        'teacher_id',
        'registration_id',
        'year',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function registration()
    {
        return $this->belongsTo(IntershipRegistration::class);
    }
}
