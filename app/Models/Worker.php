<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = [
        'noid',
        'name',
        'nik',
        'dob',
        'telp',
        'address',
        'department_id',
        'start_work_at',
        'bank_account',
        'account_name',
        'photo',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
