<?php

namespace App\Http\Requests\Warehouse;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Warehouse\StoreRequestParams;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'address'      => ['required', 'string', 'max:255'],
            'phone'      => ['required', 'string', 'max:255'],
        ];
    }

    public function toArray(): array
    {
        return [
            'name' => $this->get('name'),
            'address' => $this->get('address'),
            'phone' => $this->get('phone'),
        ];
    }
}
