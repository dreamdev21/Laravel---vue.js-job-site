<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProjectTypeRequest extends FormRequest
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
            'name' => 'required|unique:project_types,name' . ($this->route('project-type') ? ',' . $this->route('project-type') : ''),
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'project_type.unique' => 'The Project Type already exist!'
        ];
    }
}
