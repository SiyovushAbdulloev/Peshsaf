<?php

namespace App\Http\Requests\Params\Vendor\Utilization;

use App\Core\Http\Requests\Params\RequestParams;

class UpdateRequestParams extends RequestParams
{
    public function __construct(
        public int $clientId,
        public string $number,
        public string $date,
    ) {
    }
}
