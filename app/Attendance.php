<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id','student_id', 'date', 'absence_time', 'arrival_time', 'contact', 'reason'];

    public function students(){
      return $this->belongsTo('App\Student');
    }
}
