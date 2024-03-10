<?php

namespace App\Http\Requests\Params\Outlet;

use App\Core\Http\Requests\Params\RequestParams;

class StoreRequestParams extends RequestParams
{
    public function __construct(
        public string $name,
        public string $address,
        public string $phone,
    )
    {}
}
