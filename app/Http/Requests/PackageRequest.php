<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:users,email' . ($this->route('package') ? ',' . $this->route('package') : ''),
            'first_project_per_tester_charge' => 'required|numeric',
            'regular_per_tester_charge' => 'required|numeric',
            'discount_after_number_of_tester' => 'nullable|integer',
            'discount_type' => 'in:1,2',
            'discount_amount' => 'required_if:discount_type,1,2|numeric',
            'is_default' => 'boolean'
        ];
    }
}
