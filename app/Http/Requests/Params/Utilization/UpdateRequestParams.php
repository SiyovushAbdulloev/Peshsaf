<?php

namespace App\Http\Requests\Params\Utilization;

use App\Core\Http\Requests\Params\RequestParams;

class UpdateRequestParams extends RequestParams
{
    public function __construct(
        public string $type,
        public ?int $clientId,
        public ?int $outletId,
        public string $number,
        public string $date,
    ) {
    }
}
