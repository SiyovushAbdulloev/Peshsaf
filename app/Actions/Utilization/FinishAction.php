<?php

namespace App\Actions\Utilization;

use App\Core\Actions\CoreAction;
use App\Models\Utilization;

class FinishAction extends CoreAction
{
    public function handle(Utilization $utilization): void
    {
        if ($utilization->status()->canBe('finished')) {
            $utilization->status()->transitionTo('finished');
        }
    }
}
