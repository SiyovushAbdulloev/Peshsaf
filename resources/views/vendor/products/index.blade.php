@extends('layouts/sidebar')

@section('subhead')
    <title>Товары</title>
@endsection

@section('content')
    <h2 class="intro-y my-10 text-lg font-medium">Товары</h2>

    <div class="overflow-x-auto">
        @if($products->count())
            <table class="w-full text-left">
                <thead>
                <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300
                    [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        #
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Наименование
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Штрих код
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Qr код
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Отправитель
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Дата
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)
                    _td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                        <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->id }}</td>
                        <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->dicProduct?->name }}</td>
                        <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->dicProduct?->barcode }}</td>
                        <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->product->barcode }}</td>
                        <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->warehouse->name }}</td>
                        <td class="px-5 py-3 border-b dark:border-darkmode-300">{{ $product->created_at->format('d.m.Y') }}</td>
                        <td class="px-5 py-3 border-b dark:border-darkmode-300">
                            <x-base.button
                                class="show-product"
                                size="sm"
                                type="button"
                                variant="outline-primary"
                                data-route="{{ route('products.show', ['product' =>
                                            $product->product->dic_product_id]) }}"
                            >
                                <x-base.icon icon="fa-info"/>
                            </x-base.button>
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
