<?php

namespace App\Http\Requests\Params\User;

use App\Core\Http\Requests\Params\RequestParams;

class StoreRequestParams extends RequestParams
{
    public function __construct(
        public string $name,
        public string $address,
        public string $phone,
        public string $email,
        public int $positionId,
        public bool $isLimited,
        public ?string $expired,
        public string $password,
        public array $files,
    ) {

    }
}
