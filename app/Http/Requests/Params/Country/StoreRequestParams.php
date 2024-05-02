<?php

namespace App\Http\Requests\Params\Country;

use App\Core\Http\Requests\Params\RequestParams;

class StoreRequestParams extends RequestParams
{
    public function __construct(
        public string $name,
        public bool $isFavorite,
    ) {

    }
}
