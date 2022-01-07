<?php

namespace App\Imports;

use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\User;
use App\Http\Requests\StudentRequest;

class StudentImport implements ToModel, WithHeadingRow, WithValidation
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
    public function rules(): array
    {
        return [
            'year' => 'required',
            'grade' => 'required', 'numeric', 'min:1', 'max:\Auth::user()->curriculum_year',
            'class' => 'required', 'numeric', 'min:1', 'max:\Auth::user()->class_count',
            'number' => 'required',
            'name' => 'required', 'max:255',
        ];
    }
}
