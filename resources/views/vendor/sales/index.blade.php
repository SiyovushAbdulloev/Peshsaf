@extends('layouts/sidebar')

@section('subhead')
    <title>Продажа</title>
@endsection

@section('content')
    <div class="mt-5">
        <div class="intro-y mt-2 flex">
            <h2 class="intro-y text-lg font-medium">Продажа</h2>

            <a href="{{ route('vendor.sales.clients') }}" class="mb-2 transition duration-200 border
                inline-flex items-center
                justify-center py-2
                px-3 rounded-md ml-auto
                font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                Добавить
            </a>
        </div>

        @if($sales->count())
            <table
                id="sales-table"
                class="w-full text-left mt-5"
            >
                <thead>
                <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300
                [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        #
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Дата
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Покупатель
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
                @foreach($sales as $sale)
                    <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $sale->id }}
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $sale->date->format('d.m.Y') }}
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $sale->client->name }}
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $sale->client->address }}
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $sale->client->phone }}
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $sale->products_count }}
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300 gap-2 text-right">
                            <x-base.button
                                as="a"
                                size="sm"
                                href="{{ route('vendor.sales.show', compact('sale')) }}"
                                type="button"
                                variant="outline-primary"
                            >
                                <x-base.icon icon="fa-info"/>
                            </x-base.button>
                            @can('edit', $sale)
                                <x-base.button
                                    as="a"
                                    size="sm"
                                    href="{{ route('vendor.sales.edit', compact('sale')) }}"
                                    type="button"
                                    variant="outline-success"
                                >
                                    <x-base.icon icon="fa-pencil"/>
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
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/vendor.js')
@endPushOnce
