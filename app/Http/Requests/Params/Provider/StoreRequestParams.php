<?php

namespace App\Http\Requests\Params\Provider;

use App\Core\Http\Requests\Params\RequestParams;

class StoreRequestParams extends RequestParams
{
    public function __construct(
        public string $organizationName,
        public string $providerFullName,
        public int $countryId,
        public string $organizationAddress,
        public string $phone,
        public string $email,
        public string $organizationInfo,
        public array $files,
    ) {

    }
}
