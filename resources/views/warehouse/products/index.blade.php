@extends('layouts/sidebar')

@section('subhead')
    <title>Товары</title>
@endsection

@section('content')
    <h2 class="intro-y my-10 text-lg font-medium">Товары</h2>

    <div class="overflow-x-auto">
        @if($products->count())
            <table
                data-tw-merge
                class="w-full text-left"
            >
                <thead data-tw-merge class="">
                <tr
                    data-tw-merge
                    class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                >
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        #
                    </th>
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        Наименование
                    </th>
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        Штрих код
                    </th>
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        Остаток
                    </th>
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        Ед. измерения
                    </th>
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr
                        data-tw-merge
                        class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                    >
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $product->id }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $product->product->name }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $product->product->barcode }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $product->product->measure->name }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $product->products_count }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300 flex flex-row"
                        >
                            <a href="#" class="mr-4">
                                <x-base.lucide icon="info" />
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div role="alert" class="alert relative border rounded-md px-5 py-4 bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center"><i data-tw-merge data-lucide="alert-circle" class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
                Нет данных</div>
        @endif
    </div>
@endsection
