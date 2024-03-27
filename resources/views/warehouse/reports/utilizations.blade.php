@extends('layouts/sidebar')

@section('subhead')
    <title>Отчет по утилизациям</title>
@endsection

@section('content')
    <div class="mt-5">
        <form id="search-form">
            <input type="hidden" name="export" value="0" id="export"/>
            <div class="intro-y mt-2 flex gap-4">
                <h2 class="intro-y text-lg font-medium">Отчет по утилизациям</h2>
            </div>

            <div class="flex gap-8 mt-8 items-center box p-4">
                <x-base.form-select
                    class="w-1/4"
                    aria-label="form-select-sm example"
                    name="outlet"
                >
                    <option value="">Выберите торговую точку</option>
                    @foreach($outlets as $outlet)
                        <option value="{{$outlet->id}}" @selected(($filters['outlet'] ?? 0) == $outlet->id)>
                            {{$outlet->name}}
                        </option>
                    @endforeach
                </x-base.form-select>
                <x-base.form-select
                    class="w-1/4"
                    aria-label="form-select-sm example"
                    id="option"
                >
                    <option value="">Выберите дату</option>
                    @foreach($options as $option)
                        <option value="{{$option['value']}}" data-from="{{$option['from']}}"
                                data-to="{{$option['to']}}">
                            {{$option['label']}}
                        </option>
                    @endforeach
                </x-base.form-select>
                <x-base.litepicker
                    class="w-1/6"
                    data-single-mode="true"
                    id="from"
                    name="from"
                    value="{{$filters['from'] ?? ''}}"
                />
                <span>до</span>
                <x-base.litepicker
                    class="w-1/6"
                    data-single-mode="true"
                    id="to"
                    name="to"
                    value="{{$filters['to'] ?? ''}}"
                />
                <x-base.button
                    class="w-24"
                    variant="primary"
                >
                    Очистить
                </x-base.button>
                <x-base.button
                    class="w-24"
                    variant="primary"
                >
                    Поиск
                </x-base.button>
            </div>
        </form>

        @if($utilizationProducts->count())
            <div class="box p-4 mt-6">
                <x-base.button
                    class="w-24 block ml-auto"
                    variant="primary"
                    id="export-btn"
                    type="button"
                >
                    Экспорт
                </x-base.button>
                <table
                    id="sales-table"
                    class="w-full text-left mt-5"
                >
                    <thead class="">
                    <tr
                        class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                    >
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
                            Отправитель
                        </th>
                        <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                            Дата
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($utilizationProducts as $utilizationProduct)
                        <tr
                            class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                        >
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $utilizationProduct->dicProduct->name }}
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $utilizationProduct->dicProduct->barcode }}
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $utilizationProduct->product->barcode }}
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $utilizationProduct->utilization->returner }}
                            </td>
                            <td class="px-5 py-2 border-b dark:border-darkmode-300">
                                {{ $utilizationProduct->utilization->created_at->format('d.m.Y') }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div role="alert"
                 class="mt-8 alert relative border rounded-md px-5 py-4 bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center">
                <i data-lucide="alert-circle" class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
                Нет данных
            </div>
        @endif
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/remains.js')
@endPushOnce
