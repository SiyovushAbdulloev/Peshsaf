<?php

namespace App\Http\Requests\Params\Movement;

use App\Core\Http\Requests\Params\RequestParams;

class UpdateRequestParams extends RequestParams
{
    public function __construct(
        public int $outletId,
        public string $number,
        public string $date,
    ) {
    }
}
