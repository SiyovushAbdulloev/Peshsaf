<?php

namespace App\Http\Requests\Params\Return\Warehouse;

use App\Core\Http\Requests\Params\RequestParams;

class StoreRequestParams extends RequestParams
{
    public function __construct(
        public bool $distribute,
        public string $date,
        public string $number,
        public ?int $warehouseId,
        public array $products,
    ) {
    }
}
