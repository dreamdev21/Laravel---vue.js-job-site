<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TesterEarningRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only admin can add credit
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
            'project_id' => 'required|exists:projects,id',
            'tester_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'is_bonus' => 'required|boolean',
            'note' => 'nullable'
        ];
    }
}
