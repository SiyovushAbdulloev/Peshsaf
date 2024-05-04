<?php

namespace App\Actions\Country;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Country\StoreRequestParams;
use App\Models\Dictionaries\Country;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Country
    {
        return Country::create([
            'name'        => $params->name,
            'is_favorite' => $params->isFavorite,
        ]);
    }
}
