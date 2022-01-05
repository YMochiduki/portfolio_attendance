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
        $date = $request->date;
        $grade = $request->grade;
        $class = $request->class;
        
        $query = Attendance::query();
        $query->where('user_id','=', \Auth::id());
        $query->join('students', 'attendances.student_id', '=', 'students.id');
        // if( $date !== '' ){
        //     $query->where('date', $date);
        // }
        // if( $grade !== ''){
        //     $query->where('grade', $grade);
        // }
        // if( $class !== ''){
        //     $query->where('class', $class);
        // }
        $attendances = $query->get();
        
        return $attendances;

    }

}