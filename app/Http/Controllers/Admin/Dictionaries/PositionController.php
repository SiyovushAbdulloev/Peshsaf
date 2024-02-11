<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Position\IndexAction;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PositionController extends Controller
{
    public function index(IndexAction $action): Application|View|Factory
    {
        $positions = $action->execute();

        return view('admin.position.index', compact('positions'));
    }

    public function create(): Application|View|Factory
    {
        return view('admin.position.create');
    }
}
