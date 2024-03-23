<?php

namespace App\Http\Requests\Return;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Return\StoreRequestParams;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        return [
            'date' => ['required', 'string'],
            'client_id' => ['required', 'exists:clients,id'],
            'products' => ['required', 'array', 'min:1'],
            'products.*' => ['required', 'integer', 'exists:warehouse_remain_products,product_id'],
        ];
    }

    public function toArray(): array
    {
        return [
            'products' => $this->get('products'),
            'date' => $this->get('date'),
            'clientId' => $this->get('client_id'),
        ];
    }
}

