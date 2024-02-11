<?php

namespace App\Actions\Substance;

use App\Core\Actions\CoreAction;
use App\Http\Resources\SubstanceResource;
use App\Models\Substance;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexAction extends CoreAction
{
    public function handle(): AnonymousResourceCollection
    {
        return SubstanceResource::collection(Substance::get());
    }
}
