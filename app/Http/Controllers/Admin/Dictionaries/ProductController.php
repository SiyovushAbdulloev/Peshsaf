<?php

namespace App\Http\Controllers\Admin\Dictionaries;

use App\Actions\Country\IndexAction as CountryIndexAction;
use App\Actions\Supplier\DestroyAction;
use App\Actions\Supplier\IndexAction;
use App\Actions\Supplier\StoreAction;
use App\Actions\Supplier\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\StoreRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class ProductController extends Controller
{
    public function index(IndexAction $action): View
    {
        $suppliers = $action->execute();

        return view('admin.dictionaries.suppliers.index', compact('suppliers'));
    }

    public function create(CountryIndexAction $action): View
    {
        $countries = $action->execute();
        $supplier = new Supplier();

        return view('admin.dictionaries.suppliers.create', [
            'countries' => $countries,
            'supplier' => $supplier,
            'page' => 'create'
        ]);
    }

    public function store(StoreRequest $request, StoreAction $action): RedirectResponse
    {
        $action->execute($request->getParams());

        return redirect(route('admin.dictionaries.suppliers.index'))->with('success', 'Поставщик добавлен');
    }

    public function edit(CountryIndexAction $action, Supplier $supplier): View
    {
        $countries = $action->execute();

        return view('admin.dictionaries.suppliers.edit', compact('supplier', 'countries'));
    }

    public function update(
        UpdateRequest $request,
        UpdateAction  $action,
        Supplier      $supplier
    ): RedirectResponse
    {
        $action->execute($request->getParams(), $supplier);

        return redirect(route('admin.dictionaries.suppliers.index'))->with('success', 'Данные успешно изменены');
    }

    public function destroy(DestroyAction $action, Supplier $supplier): RedirectResponse
    {
        try {
            $action->execute($supplier);

            return redirect(route('admin.dictionaries.suppliers.index'))->with('success', 'Данные успешно удалены');
        } catch (Throwable $e) {
            logger($e->getMessage());
        }

        return back()->with('error', 'Невозможно удалить запись');
    }
}
