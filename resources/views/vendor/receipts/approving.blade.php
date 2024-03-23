@extends('layouts/sidebar')

@section('head')
    <title>Приход товаров</title>
@endsection

@section('content')
    <h2 class="intro-y mt-5 text-lg font-medium">Подтверждение</h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12">
            <div class="intro-y box mb-3 p-5">
                <h2 class="intro-y font-medium mb-3">Информация о приходе</h2>
                <div class="grid grid-cols-12 gap-3">
                    <div class="col-span-4">
                        <h2>Склад</h2>
                        <div class="border border-blue-800 rounded-xl p-3">{{ $receipt->warehouse->name
                        }}</div>
                    </div>
                    <div class="col-span-4">
                        <h2>Номер</h2>
                        <div class="border border-blue-800 rounded-xl p-3">{{ $receipt->number }}</div>
                    </div>
                    <div class="col-span-4">
                        <h2>Дата</h2>
                        <div class="border border-blue-800 rounded-xl p-3">{{ $receipt->date->format('d.m.Y')}}</div>
                    </div>
                </div>
            </div>
            <div class="intro-y box p-5">
                <form id="receipt-form" action="{{ route('customs.receipts.confirm', compact('receipt')) }}"
                      method="post">
                    @csrf

                    <x-base.table id="products" class="mt-5">
                        <x-base.table.thead variant="light">
                            <x-base.table.tr>
                                <x-base.table.th class="whitespace-nowrap">
                                    Наименование
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                    Штрих-код
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                    QR код
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                    Ед. измерения
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                </x-base.table.th>
                            </x-base.table.tr>
                        </x-base.table.thead>
                        <x-base.table.tbody>
                            @forelse($receipt->products as $key => $product)
                                <x-base.table.tr>
                                    <x-base.table.td>{{ $product->dicProduct->name }}</x-base.table.td>
                                    <x-base.table.td>{{ $product->dicProduct->barcode }}</x-base.table.td>
                                    <x-base.table.td>{{ $product->product->barcode }}</x-base.table.td>
                                    <x-base.table.td>{{ $product->dicProduct->measure->name }}</x-base.table.td>
                                    <x-base.table.td>
                                        <x-base.button
                                            size="sm"
                                            type="button"
                                            variant="outline-primary"
                                        >
                                            <x-base.icon icon="fa-info"/>
                                        </x-base.button>
                                    </x-base.table.td>
                                </x-base.table.tr>
                            @empty
                                <x-base.table.tr>
                                    <x-base.table.td colspan="5" class="text-center">No data</x-base.table.td>
                                </x-base.table.tr>
                            @endforelse
                        </x-base.table.tbody>
                    </x-base.table>

                    <h2 class="text-lg mt-4 text-left">
                        Количество товаров по накладной <span class="font-bold text-xl underline">{{
                        $receipt->products->count() }}</span>
                    </h2>

                    <livewire:vendor.receipts.approve :receipt="$receipt"/>
                </form>
            </div>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/receipts.js')
@endPushOnce
