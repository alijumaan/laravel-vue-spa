<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuickUpdateBuildingRequest extends FormRequest
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
            'status' => 'required|numeric|min:0|max:1',
            'notes' => 'nullable',
            'period_id' => 'required',
            'checked_at' => 'nullable'
        ];
    }
}
