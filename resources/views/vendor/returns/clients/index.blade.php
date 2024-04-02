@extends('layouts/sidebar')

@section('subhead')
    <title>Возврат товаров</title>
@endsection

@section('content')
    <div class="mt-5">
        <div class="intro-y my-5 flex gap-4">
            <h2 class="intro-y text-lg font-medium">Возврат товаров от покупателей</h2>
            <a href="{{ route('vendor.returns.clients.create') }}" class="mb-2 transition duration-200 border
                    inline-flex items-center
                    justify-center py-2
                    px-3 rounded-md ml-auto
                    font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                Добавить
            </a>
        </div>

        <div class="box p-4">
            <form id="search-form" class="flex flex-col gap-y-3">
                <div class="grid grid-cols-12 gap-3">
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
            @if($returns->count())
                <table
                    id="returns-table"
                    class="w-full text-left mt-5"
                >
                    <thead>
                    <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300
                [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            № н-й
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Статус
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Дата
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Клиент
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
                    @foreach($returns as $return)
                        <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)
                    _td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->number }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                <x-status :status="$return->status"/>
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->date->format('d.m.Y') }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->client->name }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->client?->address }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->client?->phone }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->products_count }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300 gap-2 text-right">
                                <x-base.button
                                    as="a"
                                    size="sm"
                                    href="{{ route('vendor.returns.clients.show', compact('return')) }}"
                                    type="button"
                                    variant="outline-primary"
                                >
                                    <x-base.icon icon="fa-info"/>
                                </x-base.button>
                                @can('edit', $return)
                                    <x-base.button
                                        as="a"
                                        size="sm"
                                        href="{{ route('vendor.returns.clients.edit', compact('return')) }}"
                                        type="button"
                                        variant="outline-success"
                                    >
                                        <x-base.icon icon="fa-pencil"/>
                                    </x-base.button>
                                    <x-base.button
                                        size="sm"
                                        class="delete-return"
                                        type="button"
                                        variant="outline-danger"
                                        data-route="{{ route('vendor.returns.clients.destroy', compact('return')) }}"
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
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/returns.js')
@endPushOnce
