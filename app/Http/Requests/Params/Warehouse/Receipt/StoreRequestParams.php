<?php

namespace App\Http\Requests\Params\Warehouse\Receipt;

use App\Core\Http\Requests\Params\RequestParams;

class StoreRequestParams extends RequestParams
{
    public function __construct(
        public int $supplierId,
        public string $number,
        public string $date,
        public ?array $products,
    ) {
    }
}
