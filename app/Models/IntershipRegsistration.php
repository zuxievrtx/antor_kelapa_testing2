<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntershipRegsistration extends Model
{
    protected $fillable = [
        'student_id',
        'company_id',
        'year',
        'approved_at',
    ];

    protected $dates = ['approved_at'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
