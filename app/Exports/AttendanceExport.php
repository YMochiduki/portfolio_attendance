<?php

namespace App\Exports;

use App\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $attendances = Attendance::attendancesAllData()
        ->select(
            'attendances.created_at',
            'date',
            'grade',
            'class',
            'number',
            'name',
            'absence_time', 
            'arrival_time', 
            'contact', 
            'reason'
        )->get();

        return $attendances;
    }
    
    public function headings():array
    {
        return [
            '入力日',
            '欠席・欠課日',
            '学年',
            '組',
            '出席番号',
            '名前',
            '欠席・欠課',
            '欠課時間',
            '連絡者',
            '理由'
        ];
    }
}
