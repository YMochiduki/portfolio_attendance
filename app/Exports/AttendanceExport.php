<?php

namespace App\Exports;

use App\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;

class AttendanceExport implements FromCollection
{

    public function collection()
    {
        // $attendances = Attendance::all()->where('user_id','=',\Auth::id());
        // $attendances = Attendance::all()
            // ->join('students','id','=','attendances.student_id')
            // ->where('user_id','=',\Auth::id());
        $attendances = Attendance::select([
                'attendances.date',
                'attendances.student_id',
                'students.id',
                'students.grade',
                'students.class',
                'students.number',
                'students.name',
                'attendances.absence_time',
                'attendances.arrivaltime',
                'attendances.contact',
                'attendance.reason',
            ])
            ->from('attendances')
            ->join('students','attendances.student_id', '=', 'students.id')->get();
                
        return $attendances;
    }
    public function headkings():array
    {
        
    }
}
