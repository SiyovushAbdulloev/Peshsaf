<?php

namespace App\Actions\Position;

use App\Core\Actions\CoreAction;
use App\Models\Position;
use Illuminate\Database\Eloquent\Collection;

class IndexAction extends CoreAction
{
    public function handle(): Collection
    {
        return Position::get();
    }
}
