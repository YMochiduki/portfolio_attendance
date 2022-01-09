<?php

namespace App\Services;

use App\Student;
use App\Attendance;

class SearchService {
    
    public function searchStudents($request)
    {
        $year = $request->year;
        $grade = $request->grade;
        $class = $request->class;
        $students = Student::where('user_id','=', \Auth::id());
        
        if( $year !== null){
            $students->where('year', $year);
        }
        if( $grade !== null){
            $students->where('grade', $grade);
        }
        if( $class !== null){
            $students->where('class', $class);
        }
        return $students->get();
    }
    
    public function searchAttendances($request)
    {
        $date = $request->input('date');
        $grade = $request->input('grade');
        $class = $request->input('class');
  
        $attendances = Attendance::attendancesAllData();
        if( $date !== '' ){
            $attendances->where('date', $date);
        }
        if( $grade !== ''){
            $attendances->where('grade', $grade);
        }
        if( $class !== ''){
            $attendances->where('class', $class);
        }
        return $attendances->get();

    }

}