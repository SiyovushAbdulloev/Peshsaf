<?php

namespace App\Http\Requests\Params\Utilization;

use App\Core\Http\Requests\Params\RequestParams;

class StoreRequestParams extends RequestParams
{
    public function __construct(
        public int $outletId,
        public string $number,
        public string $date,
        public ?array $products,
    ) {
    }
}
