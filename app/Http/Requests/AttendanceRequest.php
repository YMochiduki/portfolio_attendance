<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AttendanceRequest extends FormRequest
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
            'date' => ['required'],
            'student_id' => ['required'],
            'absence_time' => ['required'],
            'arrival_time' => ['required_if:absence_time,"欠課'],
            'contact' => ['required'],
            'reason' => ['required', 'max:200'],
        ];
    }
}
