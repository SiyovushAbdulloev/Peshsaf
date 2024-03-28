@extends('layouts/sidebar')

@section('subhead')
    <title>Приход товаров</title>
@endsection

@section('content')
    <div class="mt-5">
        <h2 class="intro-y text-lg font-medium">Приход товаров</h2>

        @if($receipts->count())
            <table id="receipts-table" class="w-full text-left col-span-12">
                <thead>
                <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
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
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            <x-status :status="$receipt->status" />
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->date->format('d.m.Y') }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->supplier?->full_name }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->supplier?->organization_address }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->supplier?->country?->name }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->supplier?->phone }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $receipt->products_count }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300 gap-2">
                            <x-base.button
                                as="a"
                                size="sm"
                                href="{{ route('customs.receipts.show', compact('receipt')) }}"
                                class="confirm-receipt"
                                type="button"
                                :variant="auth()->user()->can('confirm', $receipt) ? 'outline-warning' : 'outline-primary'"
                            >
                                @if(auth()->user()->can('confirm', $receipt))
                                    <x-base.icon icon="fa-list"/>
                                @else
                                    <x-base.icon icon="fa-info"/>
                                @endif
                            </x-base.button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div role="alert"
                 class="alert mx-auto mt-4 relative border rounded-md px-5 py-4 bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center">
                <x-base.icon icon="fa-circle-exclamation" class="text-lg mr-3"></x-base.icon>
                Нет данных
            </div>
        @endif
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/receipts.js')
@endPushOnce
