@extends('layouts/sidebar')

@section('subhead')
    <title>Товары</title>
@endsection

@section('content')
    <div class="mt-5">
        <div class="intro-y my-5 flex gap-4">
            <h2 class="intro-y text-lg font-medium">Товары</h2>
        </div>

        <div class="box p-4">
            <form id="search-form" class="flex flex-col gap-y-3">
                <div class="grid grid-cols-12 gap-3">
                    <x-base.form-select
                        class="col-span-3"
                        aria-label="form-select-sm example"
                        id="warehouse"
                        name="warehouse"
                    >
                        <option value="">Склад</option>
                        @foreach($warehouses as $warehouse)
                            <option
                                value="{{ $warehouse->id }}"
                                @selected(request()->get('warehouse') == $warehouse->id)
                            >
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </x-base.form-select>
                    <x-base.form-select
                        class="col-span-3"
                        aria-label="form-select-sm example"
                        id="option"
                        name="option"
                    >
                        <option value="">Выберите дату</option>
                        @foreach(config('project.filter-dates.options') as $option)
                            <option
                                value="{{ $option['value'] }}"
                                data-from="{{ $option['from'] }}"
                                @selected(request()->get('option') == $option['value'])
                                data-to="{{ $option['to'] }}"
                            >
                                {{ $option['label'] }}
                            </option>
                        @endforeach
                    </x-base.form-select>
                    <x-base.litepicker
                        class="col-span-3"
                        data-single-mode="true"
                        id="from"
                        name="from"
                        data-set-date="false"
                        placeholder="Дата начала"
                        value="{{ request()->get('from') }}"
                    />
                    <x-base.litepicker
                        class="col-span-3"
                        data-single-mode="true"
                        id="to"
                        name="to"
                        data-set-date="false"
                        placeholder="Дата окончания"
                        value="{{ request()->get('from') }}"
                    />
                </div>
                <div class="flex gap-4 ml-auto">
                    <x-base.button
                        class="w-24"
                        variant="primary"
                        id="search"
                    >
                        Поиск
                    </x-base.button>
                    <x-base.button
                        class="w-24"
                        variant="outline-primary"
                        id="clear"
                        type="button"
                    >
                        Очистить
                    </x-base.button>
                </div>
            </form>
        </div>

        <div class="box mt-5 p-4 overflow-x-auto">
            @if($products->count())
                <table class="w-full text-left">
                    <thead>
                    <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300
                        [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            #
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Наименование
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Штрих код
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Qr код
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Отправитель
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Дата
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)
                        _td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                            <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->id }}</td>
                            <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->dicProduct?->name }}</td>
                            <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->dicProduct?->barcode }}</td>
                            <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->product->barcode }}</td>
                            <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->warehouse->name }}</td>
                            <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->created_at->format('d.m.Y') }}</td>
                            <td class="px-5 py-3 border-b dark:border-darkmode-300">
                                <x-base.button
                                    class="show-product"
                                    size="sm"
                                    type="button"
                                    variant="outline-primary"
                                    data-route="{{ route('products.show', ['product' =>
                                                $product->product->dic_product_id]) }}"
                                >
                                    <x-base.icon icon="fa-info"/>
                                </x-base.button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div role="alert"
                     class="alert relative border rounded-md px-5 py-4 bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center">
                    <i data-tw-merge data-lucide="alert-circle" class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
                    Нет данных
                </div>
            @endif
        </div>
    </div>
@endsection
