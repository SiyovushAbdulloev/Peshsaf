<?php

namespace App\Http\Requests\Return\Client;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Return\Client\StoreRequestParams;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        return [
            'client_id'  => ['required', 'exists:clients,id'],
            'date'       => ['required', 'string'],
            'number'     => ['required', 'string'],
            'products'   => ['required', 'array', 'min:1'],
            'products.*' => [
                'required',
                'integer',
                'exists:products,id',
                'unique:refund_products,product_id',
            ],
        ];
    }

    public function toArray(): array
    {
        return [
            'clientId' => $this->get('client_id'),
            'date'     => $this->get('date'),
            'number'   => $this->get('number'),
            'products' => $this->get('products'),
        ];
    }
}

