@extends('layouts/sidebar')

@section('head')
    <title>Приход товаров</title>
@endsection

@section('content')
    <h2 class="intro-y mt-10 text-lg font-medium">Изменение</h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12">
            <div class="intro-y box p-5">
                <form action="{{ route('warehouse.receipts.update', compact('receipt')) }}" method="post">
                    @csrf
                    @method('PATCH')

                    @include('warehouse.receipts.partials.form')

                    <x-base.table id="receipts" class="mt-5">
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
                            @foreach($receipt->products as $product)
                                <x-base.table.tr>
                                    <x-base.table.td>{{ $product->product->name }}</x-base.table.td>
                                    <x-base.table.td>{{ $product->product->barcode }}</x-base.table.td>
                                    <x-base.table.td>
                                        <x-base.form-input
                                            class="form-control"
                                            name="products[{{$product->id}}]"
                                            type="number"
                                            :value='old("count.$product->id", $product->count)'
                                            required
                                        />
                                        @error("products.$product->id")
                                        <div class="mt-2 text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </x-base.table.td>
                                    <x-base.table.td>{{ $product->product->measure->name }}</x-base.table.td>
                                    <x-base.table.td>
                                        <x-base.button
                                            id="delete-product"
                                            type="button"
                                            variant="outline-danger"
                                            data-id="{{ $product->id }}"
                                        >
                                            <x-base.lucide icon="trash"/>
                                        </x-base.button>
                                    </x-base.table.td>
                                </x-base.table.tr>
                            @endforeach
                        </x-base.table.tbody>
                    </x-base.table>

                    <div class="flex">
                        <h2 class="text-lg mt-4 ml-5">
                            Количество товаров по накладной <span class="font-bold text-xl underline">{{
                        $receipt->products->count() }}</span>
                        </h2>

                        <div class="mt-5 ml-auto">
                            <x-base.button
                                as="a"
                                :href="route('warehouse.receipts.index')"
                                class="mr-1 w-24"
                                type="button"
                                variant="outline-secondary"
                            >
                                Отмена
                            </x-base.button>
                            <x-base.button
                                class="w-24"
                                type="button"
                                variant="primary"
                                type="submit"
                            >
                                Сохранить
                            </x-base.button>
                        </div>
                    </div>
                </form>

                <form id="send-form" action="{{ route('warehouse.receipts.send', compact('receipt')) }}" method="POST">
                    @csrf

                    <div class="flex">
                        <div class="text-lg ml-5 flex flex-row items-center">
                            <x-base.form-check.input
                                class="mr-2 border"
                                id="make-qr"
                                type="checkbox"
                            />
                            <label
                                class="cursor-pointer select-none"
                                for="make-qr"
                            >
                                Сформировать QR код: <span class="font-bold text-xl underline">{{
                    $receipt->products->count() }}</span>
                            </label>
                        </div>
                        <div class="text-lg ml-10 flex items-center">
                            <span>Формат:</span>
                            <x-base.form-select
                                class="ml-3"
                            >
                                <option>A4</option>
                            </x-base.form-select>
                        </div>

                        <x-base.button
                            class="w-44 ml-20 text-white"
                            type="button"
                            variant="success"
                            id="send"
                        >
                            Отправить документ ТАМОЖНЕЙ
                        </x-base.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/receipts.js')
@endPushOnce
