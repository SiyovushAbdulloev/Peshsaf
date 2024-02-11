<?php

namespace App\Actions\Position;

use App\Core\Actions\CoreAction;
use App\Http\Requests\Params\Position\StoreRequestParams;
use App\Models\Position;

class UpdateAction extends CoreAction
{
    public function handle(StoreRequestParams $params, Position $position): Position
    {
        $position->update([
            'name' => $params->name
        ]);

        return $position;
    }
}
