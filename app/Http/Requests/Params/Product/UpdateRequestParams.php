<?php

namespace App\Http\Requests\Params\Product;

use App\Core\Http\Requests\Params\RequestParams;

class UpdateRequestParams extends RequestParams
{
    public function __construct(
        public string $name,
        public int $activeIngredientId,
        public int $measureId,
        public int $countryId,
        public string $status,
        public string $expireDate,
        public int $barcode,
        public string $description,
        public ?array $files,
    ) {

    }
}
