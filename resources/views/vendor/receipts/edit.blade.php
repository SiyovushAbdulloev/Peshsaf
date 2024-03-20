@extends('layouts/sidebar')

@section('head')
    <title>Приход товаров</title>
@endsection

@section('content')
    <h2 class="intro-y mt-5 text-lg font-medium">Изменение</h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12">
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
                                Qr-код
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap">
                                Ед. измерения
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap">
                            </x-base.table.th>
                        </x-base.table.tr>
                    </x-base.table.thead>
                    <x-base.table.tbody>
                        @forelse($receipt->products as $product)
                            <x-base.table.tr>
                                <x-base.table.td>{{ $product->dicProduct->name }}</x-base.table.td>
                                <x-base.table.td>{{ $product->dicProduct->barcode }}</x-base.table.td>
                                <x-base.table.td>{{ $product->product->barcode }}</x-base.table.td>
                                <x-base.table.td>{{ $product->dicProduct->measure->name }}</x-base.table.td>
                                <x-base.table.td>
                                    <x-base.button
                                        class="delete-product"
                                        type="button"
                                        variant="outline-danger"
                                        data-route="{{ route('vendor.receipts.products.destroy', compact('receipt',
                                                                                        'product'))
                                                                                         }}"
                                    >
                                        <x-base.lucide icon="trash"/>
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

                <div class="flex">
                    <div class="mt-5 ml-auto flex gap-4">
                        <x-base.button
                            as="a"
                            :href="route('vendor.receipts.index')"
                            class="mr-1 w-24"
                            type="button"
                            variant="outline-secondary"
                        >
                            Отмена
                        </x-base.button>
                        <form id="send-form" action="{{ route('vendor.receipts.send', compact('receipt')) }}"
                              method="POST">
                            @csrf

                            <div class="flex">
                                <x-base.button
                                    class="w-30 text-white"
                                    type="button"
                                    variant="success"
                                    id="send"
                                >
                                    Применить
                                </x-base.button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/receipts.js')
@endPushOnce
