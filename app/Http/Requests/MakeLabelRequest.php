<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeLabelRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'required',
            'combination' => 'required|integer',
            'product' => 'required|integer',
            'order_number' => 'required|integer',
            'weight' => 'required|integer',
        ];
    }
}
