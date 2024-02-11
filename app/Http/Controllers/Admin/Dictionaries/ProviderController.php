<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Provider\IndexAction;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProviderController extends Controller
{
    public function index(IndexAction $action): Application|View|Factory
    {
        $providers = $action->execute();

        return view('admin.provider.index', compact('providers'));
    }
}
