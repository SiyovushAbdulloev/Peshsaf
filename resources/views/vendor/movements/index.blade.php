@extends('layouts/sidebar')

@section('subhead')
    <title>Перемещение товаров</title>
@endsection

@section('content')
    <div class="mt-5">
        <form id="search-form">
            <div class="intro-y mt-2 flex">
                <h2 class="intro-y text-lg font-medium">Перемещение товаров</h2>

                <a href="{{ route('vendor.movements.create') }}" class="mb-2 transition duration-200 border
                inline-flex items-center
                justify-center py-2
                px-3 rounded-md ml-auto
                font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                    <x-base.icon icon="fa-plus" class="mr-2"/>
                    Добавить
                </a>
            </div>

            <div class="flex gap-8 items-center box p-4">
                <x-base.form-select
                    class="w-1/4"
                    aria-label="form-select-sm example"
                    id="option"
                    name="option"
                >
                    <option value="">Выберите дату</option>
                    @foreach($options as $option)
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
                    class="w-1/6"
                    data-single-mode="true"
                    id="from"
                    name="from"
                    data-set-date="false"
                    placeholder="Дата начала"
                    value="{{ request()->get('from') }}"
                />
                <x-base.litepicker
                    class="w-1/6"
                    data-single-mode="true"
                    id="to"
                    name="to"
                    data-set-date="false"
                    placeholder="Дата окончания"
                    value="{{ request()->get('to') }}"
                />
                <div class="flex gap-4">
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
            </div>
        </form>

        <div class="box p-4 mt-6 overflow-x-auto">
            @if($movements->count())
                <table id="movements-table" class="w-full text-left">
                    <thead>
                    <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)
                    _td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
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
                            Торговая точка
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
                    @foreach($movements as $movement)
                        <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)
                        _td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $movement->number }}
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                <x-status :status="$movement->status"/>
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $movement->date->format('d.m.Y') }}
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $movement->outlet->name }}
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $movement->outlet->address }}
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $movement->outlet->phone }}
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $movement->products_count }}
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300 gap-2 text-right">
                                <x-base.button
                                    as="a"
                                    size="sm"
                                    href="{{ route('vendor.movements.show', compact('movement')) }}"
                                    type="button"
                                    variant="outline-primary"
                                >
                                    <x-base.icon icon="fa-info"/>
                                </x-base.button>
                                @can('edit', $movement)
                                    <x-base.button
                                        as="a"
                                        size="sm"
                                        href="{{ route('vendor.movements.edit', compact('movement')) }}"
                                        type="button"
                                        variant="outline-success"
                                    >
                                        <x-base.icon icon="fa-pencil"/>
                                    </x-base.button>
                                    <x-base.button
                                        size="sm"
                                        class="delete-movement"
                                        type="button"
                                        variant="outline-danger"
                                        data-route="{{ route('vendor.movements.destroy', compact('movement')) }}"
                                    >
                                        <x-base.icon icon="fa-trash"/>
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

        <div class="mt-4">
            {{ $movements->links() }}
        </div>
    </div>

    <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/movements.js')
    @vite('resources/js/pages/project/reports.js')
@endPushOnce
