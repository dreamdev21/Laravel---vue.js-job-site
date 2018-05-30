<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class DeviceRequest extends FormRequest
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
            'name' => 'required|unique:devices,name,NULL,id,deleted_at,NULL' . ($this->route('device') ? ',' . $this->route('device') : ''),
            'status' => 'required',
            'icon' => 'image'
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'Device already exist'
        ];
    }
}
