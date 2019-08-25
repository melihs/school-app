<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name','code'
    ];

    public function parent()
    {
       return $this->belongsTo(User::class,'user_id');
    }
}
