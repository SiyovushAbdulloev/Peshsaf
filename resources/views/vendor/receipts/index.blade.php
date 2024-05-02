@extends('layouts/sidebar')

@section('subhead')
    <title>Приход товаров</title>
@endsection

@section('content')
    <div class="mt-5">
        <div class="intro-y my-5 flex gap-4">
            <h2 class="intro-y text-lg font-medium">Приход товаров</h2>
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
                        value="{{ request()->get('to') }}"
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
            @if($receipts->count())
                <table
                    id="receipts-table"
                    class="w-full text-left col-span-12"
                >
                    <thead>
                    <tr
                        class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                    >
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            #
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Статус
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Дата
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Отправитель
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Адрес
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Телефон
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Количество
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap w-[12%]">
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($receipts as $receipt)
                        <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->number }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                <x-status :status="$receipt->status"/>
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->date->format('d.m.Y') }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->model?->name }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->model?->address ?? '-'
                            }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->model?->phone ?? '-'
                            }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->products_count }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300 gap-2">
                                <x-base.button
                                    as="a"
                                    size="sm"
                                    href="{{ route('vendor.receipts.show', compact('receipt')) }}"
                                    type="button"
                                    variant="outline-primary"
                                >
                                    <x-base.icon icon="fa-info"/>
                                </x-base.button>
                                @can('approve', $receipt)
                                    <x-base.button
                                        as="a"
                                        size="sm"
                                        href="{{ route('vendor.receipts.show', compact('receipt')) }}"
                                        type="button"
                                        variant="outline-warning"
                                    >
                                        <x-base.icon icon="fa-check"/>
                                    </x-base.button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div role="alert"
                     class="alert relative border rounded-md px-5 py-4 bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center">
                    <i data-tw-merge data-lucide="alert-circle"
                       class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
                    Нет данных
                </div>
            @endif
        </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/receipts.js')
@endPushOnce
