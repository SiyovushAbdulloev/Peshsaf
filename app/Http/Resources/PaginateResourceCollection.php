<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

abstract class PaginateResourceCollection extends JsonResource
{
    public static $wrap = null;

    public static function collection($resource): MissingValue|array
    {
        if ($resource instanceof MissingValue) {
            return $resource;
        }

        $collection = parent::collection($resource);

        return $collection->response()->getData(true);
    }
}
