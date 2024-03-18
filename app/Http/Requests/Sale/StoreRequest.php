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
            'client_id'      => ['nullable', 'exists:clients,id'],
            'client_name'    => ['required', 'string', 'max:255'],
            'client_address' => ['required', 'string', 'max:255'],
            'client_phone'   => ['required', 'string'],
            'client_photo'   => ['nullable', 'file', 'max:1024'],
            'date'           => ['required', 'string'],
            'products'       => ['required', 'array', 'min:1'],
            'products.*'     => ['required', 'integer', 'exists:warehouse_remain_products,product_id'],
        ];
    }

    public function toArray(): array
    {
        return [
            'clientId'      => $this->get('client_id'),
            'clientName'    => $this->get('client_name'),
            'clientPhone'   => $this->get('client_phone'),
            'clientAddress' => $this->get('client_address'),
            'clientPhoto'   => $this->file('client_photo'),
            'date'          => $this->get('date'),
            'products'      => $this->get('products'),
        ];
    }
}
