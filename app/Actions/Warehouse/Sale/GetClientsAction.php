<?php

namespace App\Actions\Warehouse\Sale;

use App\Core\Actions\CoreAction;
use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;

class GetClientsAction extends CoreAction
{
    public function handle(string $query): Collection|bool|null
    {
        if (strlen($query) < 3) {
            return false;
        }

        return Client::filter(['q' => $query])->get();
    }
}
