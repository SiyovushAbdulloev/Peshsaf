<?php

namespace App\Http\Requests\Params\Return;

use App\Core\Http\Requests\Params\RequestParams;

class StoreRequestParams extends RequestParams
{
    public function __construct(
        public int $clientId,
        public string $date,
        public array $products,
    ) {
    }
}
