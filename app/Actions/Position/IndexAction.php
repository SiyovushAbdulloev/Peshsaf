<?php

namespace App\Actions\Position;

use App\Core\Actions\CoreAction;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexAction extends CoreAction
{
    public function handle(): AnonymousResourceCollection
    {
        return PositionResource::collection(Position::get());
    }
}
