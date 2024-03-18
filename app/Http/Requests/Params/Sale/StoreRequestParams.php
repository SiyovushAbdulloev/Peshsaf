<?php

namespace App\Http\Requests\Params\Sale;

use App\Core\Http\Requests\Params\RequestParams;
use Illuminate\Http\UploadedFile;

class StoreRequestParams extends RequestParams
{
    public function __construct(
        public string|int|null $clientId,
        public string $clientName,
        public string $date,
        public string $clientPhone,
        public string $clientAddress,
        public ?UploadedFile $clientPhoto,
        public array $products,
    ) {
    }
}
