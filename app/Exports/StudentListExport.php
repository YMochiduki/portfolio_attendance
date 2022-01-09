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
            'year',
            'grade',
            'class',
            'number',
            'name',
        ];
    }
}
