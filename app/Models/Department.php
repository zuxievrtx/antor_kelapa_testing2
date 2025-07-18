<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'code',
        'name',
    ];
    
    public function worker(){
        return $this->hasMany(Worker::class);
    }
}
