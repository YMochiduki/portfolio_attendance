<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['user_id','student_id', 'date', 'absence_time', 'arrival_time', 'contact', 'reason'];
    
    public function scopeAttendancesAllData($query){
      $query = Attendance::query();
      $query->where('user_id','=', \Auth::id());
      $query->join('students', 'attendances.student_id', '=', 'students.id');

        return $query;
    }

    public function student(){
      return $this->belongsTo('App\Student');
    }
}