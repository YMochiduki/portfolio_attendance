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
            'year' => 'required',
            'grade' => 'required|integer|min:1|max:{\Auth::user()->curriculum_year}',
            'class' => 'required', 'numeric', 'min:1', 'max:{\Auth::user()->class_count}',
            'number' => 'required', 'numeric',
            'name' => 'required', 'max:255'
        ];
    }
}
