<?php

namespace App\Http\Requests\Params\User;

use App\Core\Http\Requests\Params\RequestParams;

class UpdateRequestParams extends RequestParams
{
    public function __construct(
        public string $name,
        public string $address,
        public string $phone,
        public string $email,
        public int $positionId,
        public ?int $warehouseId,
        public ?int $outletId,
        public bool $isLimited,
        public string $role,
        public ?string $expired,
        public ?string $password,
        public ?array $files,
    ) {

    }
}
