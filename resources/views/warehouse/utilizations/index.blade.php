@extends('layouts/sidebar')

@section('subhead')
    <title>Утилизация товаров</title>
@endsection

@section('content')
    <div class="mt-5">
        <div class="intro-y mt-2 flex">
            <h2 class="intro-y text-lg font-medium">Утилизация товаров</h2>

            <a href="{{ route('warehouse.utilizations.create') }}" class="mb-2 transition duration-200 border
                inline-flex items-center
                justify-center py-2
                px-3 rounded-md ml-auto
                font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                Добавить
            </a>
        </div>

        <div class="box p-4 mt-6 overflow-x-auto">
            @if($utilizations->count())
                <table
                    id="utilizations-table"
                    data-tw-merge
                    class="w-full text-left"
                >
                    <thead data-tw-merge class="">
                    <tr
                        data-tw-merge
                        class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                    >
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            #
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            Статус
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            Дата
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            Торговая точка
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            Адрес
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            Телефон
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            Количество
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap w-[12%]"
                        >
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($utilizations as $utilization)
                        <tr
                            data-tw-merge
                            class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                        >
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $utilization->number }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $utilization->status }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $utilization->date->format('d.m.Y') }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $utilization->outlet->name }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $utilization->outlet->address }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $utilization->outlet->phone }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $utilization->products_count }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300 gap-2 text-right"
                            >
                                <x-base.button
                                    as="a"
                                    size="sm"
                                    href="{{ route('warehouse.utilizations.show', compact('utilization')) }}"
                                    type="button"
                                    variant="outline-primary"
                                >
                                    <x-base.lucide icon="info"/>
                                </x-base.button>
                                @can('edit', $utilization)
                                    <x-base.button
                                        as="a"
                                        size="sm"
                                        href="{{ route('warehouse.utilizations.edit', compact('utilization')) }}"
                                        type="button"
                                        variant="outline-success"
                                        data-route="{{ route('warehouse.utilizations.destroy', compact('utilization')) }}"
                                    >
                                        <x-base.lucide icon="pencil"/>
                                    </x-base.button>
                                    <x-base.button
                                        size="sm"
                                        class="delete-utilization"
                                        type="button"
                                        variant="outline-danger"
                                        data-route="{{ route('warehouse.utilizations.destroy', compact('utilization')) }}"
                                    >
                                        <x-base.lucide icon="trash"/>
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
                    <i data-tw-merge data-lucide="alert-circle" class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
                    Нет данных
                </div>
            @endif
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/utilizations.js')
@endPushOnce
