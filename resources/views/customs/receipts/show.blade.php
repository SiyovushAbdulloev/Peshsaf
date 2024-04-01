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
                        <h2>Организация</h2>
                        <div class="border border-blue-800 rounded-xl p-3">{{ $receipt->supplier->organization_name
                        }}</div>
                    </div>
                    <div class="col-span-4">
                        <h2>Поставщик</h2>
                        <div class="border border-blue-800 rounded-xl p-3">{{ $receipt->supplier->full_name }}</div>
                    </div>
                    <div class="col-span-4">
                        <h2>Адрес</h2>
                        <div class="border border-blue-800 rounded-xl p-3">{{ $receipt->supplier->organization_address
                        }}</div>
                    </div>
                    <div class="col-span-4">
                        <h2>Телефон</h2>
                        <div class="border border-blue-800 rounded-xl p-3">{{ $receipt->supplier->phone }}</div>
                    </div>
                    <div class="col-span-4">
                        <h2>Дата прихода</h2>
                        <div class="border border-blue-800 rounded-xl p-3 flex">
                            <span>{{ $receipt->date->format('d.m.Y') }}</span>
                            <x-base.icon icon="fa-calendar" class="ml-auto my-auto leading-3 text-lg"/>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <h2>Документы компании</h2>
                        <div class="flex flex-col p-3 bg-amber-200 rounded-xl gap-3">
                            @forelse($receipt->supplier->files ?? [] as $file)
                                <a href="{{ $file->url }}" target="_blank" class="flex items-center gap-1 text-blue-600
                                w-100">
                                    <x-base.icon icon="fa-paperclip" class=" leading-3 text-lg"/>
                                    <span class="truncate text-center font-medium">{{ $file->original_filename }}</span>
                                </a>
                            @empty
                                <span class="italic text-gray-600">Нет документов</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-y box p-5">
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
                                Количество
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
                                <x-base.table.td>{{ $product->product->name }}</x-base.table.td>
                                <x-base.table.td>{{ $product->product->barcode }}</x-base.table.td>
                                <x-base.table.td>{{ $product->count }}</x-base.table.td>
                                <x-base.table.td>{{ $product->product->measure->name }}</x-base.table.td>
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

                <h2 class="text-lg mt-4 text-right">
                    Количество товаров по накладной <span class="font-bold text-xl underline">{{
                    $receipt->products->sum('count') }}</span>
                </h2>

                <livewire:customs.receipts.actions :receipt="$receipt"/>
            </div>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/receipts.js')
@endPushOnce
