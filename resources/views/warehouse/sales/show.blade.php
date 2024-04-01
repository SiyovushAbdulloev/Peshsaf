@extends('layouts/sidebar')

@section('head')
    <title>Просмотр продажи</title>
@endsection

@section('content')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Просмотр</h2>
    </div>

    <div class="intro-y mt-5 grid grid-cols-11 gap-5">
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
            <div class="box rounded-md p-5">
                <div class="mb-5 flex items-center border-b border-slate-200/60 pb-5 dark:border-darkmode-400">
                    <div class="truncate text-base font-medium">
                        Детали продажи
                    </div>
                </div>
                <div class="flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-user"
                    />
                    Клиент: <span class="ml-2">{{ $sale->client_name }}</span>
                </div>
                <div class="mt-3 flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-phone"
                    />
                    Телефон: <span class="ml-2">{{ $sale->client_phone }}</span>
                </div>
                <div class="mt-3 flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-location-dot"
                    />
                    Адрес: <span class="ml-2">{{ $sale->client_address }}</span>
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
                                    QR код
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
                            @foreach ($sale->products as $product)
                                <x-base.table.tr>
                                    <x-base.table.td class="!py-4">
                                        {{ $product->dicProduct?->name }}
                                    </x-base.table.td>
                                    <x-base.table.td>
                                        {{ $product->dicProduct?->barcode }}
                                    </x-base.table.td>
                                    <x-base.table.td>
                                        {{ $product->product->barcode }}
                                    </x-base.table.td>
                                    <x-base.table.td>
                                        {{ $product->dicProduct->measure->name }}
                                    </x-base.table.td>
                                    <x-base.table.td class="text-right">
                                        <x-base.button
                                            size="sm"
                                            type="button"
                                            variant="outline-primary"
                                        >
                                            <x-base.lucide icon="info"/>
                                        </x-base.button>
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
                    :href="route('warehouse.sales.index')"
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
