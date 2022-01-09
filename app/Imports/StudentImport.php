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
        // return new Student([
        //     'year' => $row['年度'],
        //     'user_id' => \Auth::user()->id,
        //     'grade' => $row['学年'],
        //     'class' => $row['クラス'],
        //     'number' => $row['出席番号'],
        //     'name' => $row['名前'],
        // ]);
    
        // return new Student([
        //     'year' => $row[0],
        //     'user_id' => \Auth::user()->id,
        //     'grade' => $row[2],
        //     'class' => $row[3],
        //     'number' => $row[4],
        //     'name' => $row[5],
        // ]);
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
            'grade' => 'required',
            'class' => 'required',

            // 'grade' => 'required|integer|min:1|max:{\Auth::user()->curriculum_year}',
            // 'class' => 'required|integer|min:1|max:{\Auth::user()->class_count}',
            'grade' => 'required', 'numeric', 'min:1','integer|max:{\Auth::user()->curriculum_year}',
            'class' => 'required', 'numeric', 'min:1','max:'[\Auth::user()->class_count],
            'number' => 'required', 'numeric',
            'name' => 'required', 'max:255'
        ];
    }
    
    public function customValidationMessages()
   {
    return [
        'year.required' => '年度(year)が入力されていません',
        'grade.required' => '学年(grade)が入力されていません',
        'class.required' => '組(class)が入力されていません',
        'number.required' => '出席番号(number)が入力されていません',
        'name.required' => '名前(name)が入力されていません',
        // 'grade.integer' => '学年(grade)には数字を入力してください',
        // 'grade.min' => '学年(grade)には1以上の数字を入れてください',
        // 'grade.max' => '学年(grade)には' . \Auth::user()->curriculum_year . '以下の数字を入れてください',
        // 'class.integer' => '組(class)には数字を入力してください',
        // 'class.min' => '組(class)には1以上の数字を入れてください',
        // 'class.max' => '組(class)には' . \Auth::user()->class_count . '以下の数字を入れてください',
    ];
   }
}
