<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\User;


class StudentImport implements ToModel, WithHeadingRow
{
    use Importable;
    public function model(array $row)
    {
        return new Student([
            'year' => $row['year'],
            'user_id' => \Auth::user()->id,
            'grade' => $row['grade'],
            'class' => $row['class'],
            'number' => $row['number'],
            'name' => $row['name'],
        ]);
    }
}
