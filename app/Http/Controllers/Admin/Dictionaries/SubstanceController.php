<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Substance\IndexAction;
use App\Actions\Substance\StoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Substance\StoreRequest;
use App\Http\Resources\SubstanceResource;
use App\Models\Substance;
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

    public function store(StoreRequest $request, StoreAction $action): SubstanceResource
    {
        $substance = $action->execute($request->getParams());

        return new SubstanceResource($substance);
    }

    public function edit(Substance $substance): Application|View|Factory
    {
        return view('admin.substance.edit', compact('substance'));
    }
}
