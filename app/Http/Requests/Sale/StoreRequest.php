<?php

namespace App\Http\Requests\Sale;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Sale\StoreRequestParams;

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
            'client_id'   => ['nullable', 'exists:clients,id'],
            'client_name' => ['required', 'string', 'max:255'],
            'date'        => ['required', 'string'],
            'phone'       => ['required', 'string'],
            'address'     => ['required', 'string', 'max:255'],
            'photo'       => ['nullable', 'file', 'max:1024'],
            'products'    => ['required', 'array', 'min:1'],
            'products.*'  => ['required', 'integer', 'exists:products,id'],
        ];
    }

    public function toArray(): array
    {
        return [
            'clientId'   => $this->get('client_id'),
            'clientName' => $this->get('client_name'),
            'date'       => $this->get('date'),
            'phone'      => $this->get('phone'),
            'address'    => $this->get('address'),
            'photo'      => $this->file('photo'),
            'products'   => $this->get('products'),
        ];
    }
}
