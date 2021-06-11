<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBuildingRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'nullable',
            'number' => 'required|string|max:255',
            'status' => 'required|numeric|min:0|max:1',
            'notes' => 'nullable',
            'user_id' => 'required',
            'period_id' => 'required',
        ];
    }
}
