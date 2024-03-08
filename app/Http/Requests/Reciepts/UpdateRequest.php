<?php

namespace App\Http\Requests\Reciepts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'number'      => ['required', 'string', 'max:255'],
            'date'        => ['required', 'string'],
            'products'    => ['required', 'array', 'min:1'],
        ];
    }
}
