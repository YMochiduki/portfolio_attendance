<?php

namespace App\Services;

use App\Student;
use App\Attendance;

class SearchService {
    
    public function searchStudents($request)
    {
        $students = '';
        $search = $request->search;
        $students = Student::where('grade', $request->grade)->where('class', $request->class)->get();
        
        return $students;
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