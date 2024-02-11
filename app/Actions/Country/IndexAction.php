<?php

namespace App\Actions\Country;

use App\Core\Actions\CoreAction;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexAction extends CoreAction
{
    public function handle(): AnonymousResourceCollection
    {
        return CountryResource::collection(Country::get());
    }
}
