<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Position\IndexAction;
use App\Actions\Position\StoreAction;
use App\Actions\Position\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Position\StoreRequest;
use App\Http\Resources\PositionResource;
use App\Models\Position;
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

    public function store(StoreRequest $request, StoreAction $action): PositionResource
    {
        $position = $action->execute($request->getParams());

        return new PositionResource($position);
    }

    public function edit(Position $position): Application|View|Factory
    {
        return view('admin.position.edit', compact('position'));
    }

    public function update(
        StoreRequest $request,
        UpdateAction $action,
        Position $position
    ): PositionResource
    {
        $position = $action->execute($request->getParams(), $position);

        return new PositionResource($position);
    }
}
