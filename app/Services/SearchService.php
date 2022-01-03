<?php

namespace App\Services;

use App\Student;


class SearchService {
    
    public function searchStudents($request)
    {
        $students = '';
        $search = $request->search;
        $students = Student::where('grade', $request->grade)->where('class', $request->class)->get();
        
        return $students;
    }
}