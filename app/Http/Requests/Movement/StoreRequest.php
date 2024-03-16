<?php

namespace App\Http\Requests\Movement;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Movement\StoreRequestParams;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

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
            'outlet_id'  => ['required', 'exists:outlets,id'],
            'number'     => ['required', 'string', 'max:255'],
            'date'       => ['required', 'string'],
            'products'   => ['required', 'array', 'min:1'],
            'products.*' => ['exists:products,id'],
        ];
    }

    public function toArray(): array
    {
        return [
            'outletId' => $this->get('outlet_id'),
            'number'   => $this->get('number'),
            'date'     => $this->get('date'),
            'products' => $this->get('products'),
        ];
    }
}
