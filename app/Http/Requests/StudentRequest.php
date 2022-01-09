<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'year' => ['required'],
            'grade' => ['required','numeric'],
            'class' => ['required', 'numeric', 'min:1'],
            'number' => ['required', 'numeric'],
            'name' => ['required', 'max:255']
            //課題：最大値を変数にしたいが、うまく動作しない
            // 'grade' => ['required','numeric','min:1',"integer|max:${\Auth::user()->curriculum_year}"],
            // 'class' => ['required', 'numeric', 'min:1', 'integer|max:{\Auth::user()->class_count}'],

        ];
    }
}
