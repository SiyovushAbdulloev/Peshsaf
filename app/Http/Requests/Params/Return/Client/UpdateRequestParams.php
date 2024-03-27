<?php

namespace App\Http\Requests\Params\Return\Client;

use App\Core\Http\Requests\Params\RequestParams;

class UpdateRequestParams extends RequestParams
{
    public function __construct(
        public string $date,
        public string $number,
    ) {
    }
}
