<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id','students_id', 'date', 'absence_time', 'arrival_time', 'contact', 'reason'];
}
