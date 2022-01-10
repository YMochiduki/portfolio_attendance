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
            'year' => ['required','numeric'],
            'grade' => ['required', 'numeric', 'min:1'],
            'class' => ['required', 'numeric', 'min:1'],
            'number' => ['required', 'numeric'],
            'name' => ['required', 'max:255']
        ];
    }

// バリデーションメッセージ不調要検証
    public function customValidationMessages()
  {
    return [
        'year.required' => '年度(year)が入力されていない行があります。',
        'grade.required' => '学年(grade)が入力されていない行があります。',
        'class.required' => '組(class)が入力されていない行があります。',
        'number.required' => '出席番号(number)が入力されていない行があります。',
        'name.required' => '名前(name)が入力されていない行があります。',
        'grade.numeric' => '学年(grade)は数字を入力してください。',
        'class.numeric' => '組(class)は数字を入力してください。',
        'number.numeric' => '出席番号(number)は数字を入力してください。',
    ];
  }
}
