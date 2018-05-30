<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProjectRequest extends FormRequest
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
            'name' => 'required',
            'cost_per_tester' => 'required_if:status,PENDING_PAYMENT',
            'allocated_tester' => 'required_if:status,PENDING_PAYMENT',
            'total_cost' => 'required_if:status,PENDING_PAYMENT'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Project already exist!'
        ];
    }
}
