<?php

namespace App\Actions\Supplier;

use App\Core\Actions\CoreAction;
use App\Http\Resources\IndexPage\ProviderResource;
use App\Models\Supplier;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexAction extends CoreAction
{
    public function handle(): AnonymousResourceCollection
    {
        return ProviderResource::collection(Supplier::with('country')->get());
    }
}
