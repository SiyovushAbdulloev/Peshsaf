@extends('layouts/sidebar')

@section('subhead')
    <title>Приход товаров</title>
@endsection

@section('content')
    <div class="mt-5">
        <div class="intro-y mt-2 flex">
            <h2 class="intro-y text-lg font-medium">Приход товаров</h2>

            <a href="{{ route('warehouse.receipts.create') }}" class="mb-2 transition duration-200 border
                inline-flex items-center
                justify-center py-2
                px-3 rounded-md ml-auto
                font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                Добавить
            </a>
        </div>
        <div class="box p-4 mt-6 overflow-x-auto">
            @if($receipts->count())
                <table id="receipts-table" class="w-full text-left col-span-12">
                    <thead>
                    <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
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
                            Поставщик
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Адрес
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Страна
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
                        <tr
                            class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                        >
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->number }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->status }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->date->format('d.m.Y') }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->supplier?->full_name }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->supplier?->organization_address }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->supplier?->country?->name }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->supplier?->phone }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->products_count }}</td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300 gap-2 flex">
                                <x-base.button
                                    as="a"
                                    size="sm"
                                    href="{{ route('warehouse.receipts.show', compact('receipt')) }}"
                                    type="button"
                                    variant="outline-primary"
                                >
                                    <x-base.icon icon="fa-info"/>
                                </x-base.button>
                                @can('generate', $receipt)
                                    <livewire:warehouse.receipt.generate-pdf :receipt="$receipt"/>
                                @endcan
                                @can('edit', $receipt)
                                    <x-base.button
                                        as="a"
                                        size="sm"
                                        href="{{ route('warehouse.receipts.edit', compact('receipt')) }}"
                                        type="button"
                                        variant="outline-success"
                                    >
                                        <x-base.icon icon="fa-pencil"/>
                                    </x-base.button>
                                    <x-base.button
                                        size="sm"
                                        class="delete-receipt"
                                        type="button"
                                        variant="outline-danger"
                                        data-route="{{ route('warehouse.receipts.destroy', compact('receipt')) }}"
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
                    <i data-tw-merge data-lucide="alert-circle" class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
                    Нет данных
                </div>
            @endif
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/receipts.js')
@endPushOnce
