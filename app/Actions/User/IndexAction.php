<?php

namespace App\Actions\User;

use App\Core\Actions\CoreAction;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class IndexAction extends CoreAction
{
    public function handle(): Collection
    {
        return User::with('position')->get();
    }
}
