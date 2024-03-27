@extends('layouts/sidebar')

@section('subhead')
    <title>Отчет по остаткам</title>
@endsection

@section('content')
    <div class="mt-5">
        <h2 class="intro-y text-lg font-medium">Отчет по остаткам</h2>

        @if($remains->count())
            <table class="w-full text-left mt-5">
                <thead>
                <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300
                 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Наименование
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Штрих-код
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        QR-код
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Ед.Из.
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Дата оп-я товара
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($remains as $remain)
                    <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $remain->dicProduct->name }}
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $remain->dicProduct->barcode }}
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $remain->product->barcode }}
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $remain->dicProduct->measure->name }}
                        </td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">
                            {{ $remain->created_at->format('d.m.Y') }}
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
