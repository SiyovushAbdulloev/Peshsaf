<?php

namespace App\Actions\Analitics;

use App\Core\Actions\CoreAction;
use Illuminate\View\View;

class GetAdminViewAction extends CoreAction
{
    public function handle(): View
    {
        return view('dashboards.admin');
    }
}
