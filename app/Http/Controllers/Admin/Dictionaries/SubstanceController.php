<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Substance\IndexAction;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class SubstanceController extends Controller
{
    public function index(IndexAction $action): Application|View|Factory
    {
        $substances = $action->execute();

        return view('admin.substance.index', compact('substances'));
    }

    public function create(): Application|View|Factory
    {
        return view('admin.substance.create');
    }
}
