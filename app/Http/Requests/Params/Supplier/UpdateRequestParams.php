<?php

namespace App\Http\Requests\Params\Supplier;

use App\Core\Http\Requests\Params\RequestParams;

class UpdateRequestParams extends RequestParams
{
    public function __construct(
        public string $organizationName,
        public string $code,
        public string $fullName,
        public int $countryId,
        public string $organizationAddress,
        public string $phone,
        public string $email,
        public string $description,
        public ?array $files,
    ) {

    }
}
