<?php

namespace App\Http\Requests\Return\Warehouse;

use App\Core\Http\Requests\CoreFormRequest;
use App\Http\Requests\Params\Return\Warehouse\StoreRequestParams;

class StoreRequest extends CoreFormRequest
{
    protected string $params = StoreRequestParams::class;

    public function rules(): array
    {
        return [
            'distribute'   => ['required', 'in:1,0'],
            'date'         => ['required', 'string'],
            'number'       => ['required', 'string'],
            'warehouse_id' => ['nullable', 'required_if:distribute,0', 'exists:warehouses,id'],
            'products'     => ['required', 'array', 'min:1'],
            'products.*'   => ['required', 'integer', 'exists:outlet_products,product_id', 'unique:outlet_products,product_id'],
        ];
    }

    public function toArray(): array
    {
        return [
            'distribute'  => $this->get('distribute'),
            'date'        => $this->get('date'),
            'number'      => $this->get('number'),
            'warehouseId' => $this->get('warehouse_id'),
            'products'    => $this->get('products'),
        ];
    }
}

