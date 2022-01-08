<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentListExport implements FromCollection, WithHeadings
{

    public function collection()
    {
        $attendace = collect([]);
        
        return $attendace;
    }
    
        public function headings():array
    {
        return [
            '年度',
            '学年',
            '組',
            '出席番号',
            '名前',
        ];
    }
}
