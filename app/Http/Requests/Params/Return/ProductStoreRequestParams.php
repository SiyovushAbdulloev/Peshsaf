<?php

namespace App\Http\Requests\Params\Return;

use App\Core\Http\Requests\Params\RequestParams;

class ProductStoreRequestParams extends RequestParams
{
    public function __construct(
        public int|string $productId,
    ) {
    }
}
