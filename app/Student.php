<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['year','user_id','grade', 'class','number', 'name'];
}
