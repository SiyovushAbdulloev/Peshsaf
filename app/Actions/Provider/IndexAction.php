<?php

namespace App\Actions\Provider;

use App\Core\Actions\CoreAction;
use App\Http\Resources\IndexPage\ProviderResource;
use App\Models\Provider;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexAction extends CoreAction
{
    public function handle(): AnonymousResourceCollection
    {
        return ProviderResource::collection(Provider::with('country')->get());
    }
}
