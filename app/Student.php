<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['year','user_id','grade', 'class','number', 'name'];

    public function attendances(){
    return $this->hasMany('App\Attendance');
    }

}
