<?php

namespace App\Http\Controllers\Vendor\Returns;

use App\Actions\Vendor\Return\Client\StoreAction;
use App\Actions\Vendor\Return\Client\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Return\Client\StoreRequest;
use App\Http\Requests\Return\Client\UpdateRequest;
use App\Models\Refund;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ClientController extends Controller
{
    public function index(): View
    {
        $returns = auth()->user()
            ->outlet
            ->returns()
            ->filter(request()->only(['from', 'to']))
            ->type(Refund::CLIENT)
            ->withCount('products')
            ->with('client')
            ->latest()
            ->paginate();

        return view('vendor.returns.clients.index', compact('returns'));
    }

    public function show(Refund $return): View
    {
        return view('vendor.returns.clients.show', compact('return'));
    }

    public function create(): View
    {
        $return = new Refund;

        return view('vendor.returns.clients.create', compact('return'));
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $return = $action->execute($request->getParams());

        return redirect(route('vendor.returns.clients.edit', compact('return')))->with('success', 'Возврат успешно добавлен');
    }

    public function edit(Refund $return): View
    {
        $this->authorize('finish', $return);
        return view('vendor.returns.clients.edit', compact('return'));
    }

    public function update(
        Refund $return,
        UpdateRequest $request,
        UpdateAction $action
    ): RedirectResponse {
        $return = $action->execute($request->getParams(), $return);

        return redirect(route('vendor.returns.clients.edit', compact('return')))->with('success',
            'Данные успешно изменены');
    }

    public function finish(Refund $return): RedirectResponse
    {
        if ($return->status()->canBe('finished')) {
            $return->status()->transitionTo('finished');
        }

        return redirect(route('vendor.returns.clients.index'))->with('success',
            'Возврат успешно завершен');
    }

    public function destroy(Refund $return): RedirectResponse
    {
        $return->products()->delete();
        $return->delete();

        return redirect(route('vendor.returns.clients.index'))->with('success', 'Возврат успешно удален');
    }
}
