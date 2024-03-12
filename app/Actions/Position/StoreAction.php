<?php

namespace App\Actions\Position;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Position\StoreRequestParams;
use App\Models\Position;

class StoreAction extends CoreAction
{
    public function handle(StoreRequestParams $params): Position
    {
        return Position::create([
            'name' => $params->name
        ]);
    }
}
