@extends('layouts/sidebar')

@section('head')
    <title>Приход товаров</title>
@endsection

@section('content')
    <h2 class="intro-y mt-10 text-lg font-medium">Создание</h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12">
            <form action="{{ route('warehouse.receipts.store') }}" method="post">
                @csrf

                <div class="intro-y box p-5">
                    @include('warehouse.receipts.partials.form')

                    <x-base.table id="receipts" class="mt-5">
                        <x-base.table.thead variant="light">
                            <x-base.table.tr>
                                <x-base.table.th class="whitespace-nowrap">#</x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                    Наименование
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                    Штрих-код
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                    Ед. измерения
                                </x-base.table.th>
                                <x-base.table.th class="whitespace-nowrap">
                                </x-base.table.th>
                            </x-base.table.tr>
                        </x-base.table.thead>
                        <x-base.table.tbody>
                            @foreach($products as $product)
                                <x-base.table.tr>
                                    <x-base.table.td>
                                        <x-base.form-check.input
                                            class="products"
                                            type="checkbox"
                                            name="products[]"
                                            :checked="in_array($product->id, old('products') ?? [])"
                                            value="{{ $product->id }}"
                                        />
                                    </x-base.table.td>
                                    <x-base.table.td>{{ $product->name }}</x-base.table.td>
                                    <x-base.table.td>{{ $product->barcode }}</x-base.table.td>
                                    <x-base.table.td>{{ $product->measure->name }}</x-base.table.td>
                                    <x-base.table.td>
                                        <a href="#" class="mr-4">
                                            <x-base.lucide icon="info"/>
                                        </a>
                                    </x-base.table.td>
                                </x-base.table.tr>
                            @endforeach
                        </x-base.table.tbody>
                    </x-base.table>

                    <h2 class="text-lg mt-4 ml-5">
                        Количество выбранных товаров <span id="selected" class="font-bold text-xl">0</span> из
                        <span class="font-bold text-xl">{{ $products->count() }}</span>
                    </h2>

                    <div class="mt-5 text-right">
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
                            Добавить
                        </x-base.button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/receipts.js')
@endPushOnce
