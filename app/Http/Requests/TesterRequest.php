<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class TesterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email' . ($this->route('tester') ? ',' . $this->route('tester') : ''),
            'date_of_birth' => 'nullable|date_format:Y-m-d,before:' . now()->subDay()
        ];
    }
    public function messages()
    {
        return [
            'date_of_birth.before' => 'The date of birth must be less than today'
        ];
    }
}
