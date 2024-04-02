<?php

namespace App\Http\Controllers\Vendor;

use App\Actions\Vendor\Utilization\StoreAction;
use App\Actions\Vendor\Utilization\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Utilization\StoreRequest;
use App\Http\Requests\Vendor\Utilization\UpdateRequest;
use App\Models\Client;
use App\Models\Utilization;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UtilizationController extends Controller
{
    public function index(): View
    {
        $utilizations = auth()->user()
            ->outlet
            ->utilizations()
            ->filter(request()->only(['from', 'to']))
            ->with('client')
            ->withCount('products')
            ->latest()
            ->paginate(10);

        return view('vendor.utilizations.index', compact('utilizations'));
    }

    public function show(Utilization $utilization): View
    {
        return view('vendor.utilizations.show', compact('utilization'));
    }

    public function create(): View
    {
        $utilization = new Utilization;
        $clients = Client::get();

        return view('vendor.utilizations.create', compact('utilization', 'clients'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $utilization = $action->execute($request->getParams());

        return redirect(route('vendor.utilizations.edit', compact('utilization')))->with('success',
            'Утилизация успешно добавлена');
    }

    public function edit(Utilization $utilization): View
    {
        $clients = Client::get();

        return view('vendor.utilizations.edit', compact('utilization', 'clients'));
    }

    public function update(
        Utilization $utilization,
        UpdateRequest $request,
        UpdateAction $action
    ): RedirectResponse {
        $action->execute($request->getParams(), $utilization);

        return redirect(route('vendor.utilizations.edit', compact('utilization')))->with('success',
            'Данные успешно сохранены');
    }

    public function destroy(Utilization $utilization): RedirectResponse
    {
        $utilization->delete();

        return redirect(route('vendor.utilizations.index'))->with('success', 'Утилизация успешно удалена');
    }
}
