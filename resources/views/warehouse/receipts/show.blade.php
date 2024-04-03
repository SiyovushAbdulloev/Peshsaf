@extends('layouts/sidebar')

@section('head')
    <title>Просмотр прихода</title>
@endsection

@section('content')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Просмотр</h2>
    </div>

    <div class="intro-y mt-5 grid grid-cols-11 gap-5">
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
            <div class="box rounded-md p-5 flex flex-col gap-y-3">
                <div class="mb-5 flex items-center border-b border-slate-200/60 pb-5 dark:border-darkmode-400">
                    <div class="truncate text-base font-medium">
                        Детали прихода
                    </div>
                </div>
                <div class="flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-user"
                    />
                    Поставщик: <span class="ml-2">{{ $receipt->supplier->full_name }}</span>
                </div>
                <div class="flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-building"
                    />
                    Организация: <span class="ml-2">{{ $receipt->supplier->organization_name }}</span>
                </div>
                <div class="flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-location-dot"
                    />
                    Адрес: <span class="ml-2">{{ $receipt->supplier->organization_address }}</span>
                </div>
                <div class="flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-file-lines"
                    />
                    Номер накладной: <span class="ml-2">{{ $receipt->number }}</span>
                </div>
                <div class="flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-calendar"
                    />
                    Дата накладной: <span class="ml-2">{{ $receipt->date->format('d.m.Y') }}</span>
                </div>
                <div class="flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-clipboard-list"
                    />
                    Количество продуктов: <span class="ml-2">{{ $receipt->products_count }}</span>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-7 2xl:col-span-8">
            <div class="box rounded-md p-5">
                <div class="-mt-3 overflow-auto lg:overflow-visible">
                    <x-base.table striped>
                        <x-base.table.thead>
                            <x-base.table.tr>
                                <x-base.table.th class="whitespace-nowrap !py-5">
                                    Наименование
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                    Штрих код
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                    Количество
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                    Ед. измерения
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap text-right">
                                    &nbsp;
                                </x-base.table.th>
                            </x-base.table.tr>
                        </x-base.table.thead>
                        <x-base.table.tbody>
                            @foreach ($receipt->products as $product)
                                <x-base.table.tr>
                                    <x-base.table.td class="!py-4">
                                        {{ $product->product->name }}
                                    </x-base.table.td>
                                    <x-base.table.td>
                                        {{ $product->product->barcode }}
                                    </x-base.table.td>
                                    <x-base.table.td>
                                        {{ $product->count }}
                                    </x-base.table.td>
                                    <x-base.table.td>
                                        {{ $product->product->measure->name }}
                                    </x-base.table.td>
                                    <x-base.table.td class="text-right">
                                        <div class="text-center">
                                            <x-base.button
                                                class="show-product"
                                                size="sm"
                                                type="button"
                                                variant="outline-primary"
                                                data-route="{{ route('products.show', ['product' =>
                                                $product->dic_product_id]) }}"
                                            >
                                                <x-base.icon icon="fa-info"/>
                                            </x-base.button>
                                        </div>
                                    </x-base.table.td>
                                </x-base.table.tr>
                            @endforeach
                        </x-base.table.tbody>
                    </x-base.table>
                </div>
            </div>

            <div class="mt-5 text-left">
                <x-base.button
                    as="a"
                    :href="route('warehouse.receipts.index')"
                    class="mr-1 w-24"
                    type="button"
                    variant="outline-primary"
                >
                    Отмена
                </x-base.button>
            </div>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/receipts.js')
@endPushOnce
