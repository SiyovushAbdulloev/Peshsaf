@extends('layouts/sidebar')

@section('subhead')
    <title>Отчет по остаткам</title>
@endsection

@section('content')
    <div class="mt-5">
        <form id="search-form">
            <input type="hidden" name="export" value="0" id="export"/>
            <div class="intro-y mt-2 flex gap-4">
                <h2 class="intro-y text-lg font-medium">Отчет по остаткам</h2>
            </div>

            <div class="flex gap-8 mt-8 items-center box p-4">
                <x-base.form-select
                    class="w-1/4"
                    aria-label="form-select-sm example"
                    id="option"
                    name="option"
                >
                    <option value="">Выберите дату</option>
                    @foreach($options as $option)
                        <option value="{{$option['value']}}" data-from="{{$option['from']}}"
                                @selected(($filters['option'] ?? '') == $option['value'])
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
                <div class="flex gap-4">
                    <x-base.button
                        class="w-24"
                        variant="primary"
                        id="search"
                    >
                        Поиск
                    </x-base.button>
                    <x-base.button
                        class="w-24"
                        variant="outline-primary"
                        id="clear"
                    >
                        Очистить
                    </x-base.button>
                </div>
            </div>
        </form>

        <div class="box p-4 mt-6">
            <x-base.button
                class="flex gap-2 ml-auto"
                variant="outline-success"
                id="export-btn"
                type="button"
            >
                <x-base.icon icon="fa-file-excel"/>
                <span>Экспорт</span>
            </x-base.button>
            @if($remains->count())
                <table
                    id="sales-table"
                    data-tw-merge
                    class="w-full text-left mt-5"
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
                            Наименование
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            Штрих-код
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            QR-код
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            Ед.Из.
                        </th>
                        <th
                            data-tw-merge
                            class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                        >
                            Дата оп-я товара
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($remains as $remain)
                        <tr
                            data-tw-merge
                            class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                        >
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $remain->dicProduct->name }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $remain->dicProduct->barcode }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $remain->product->barcode }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $remain->dicProduct->measure->name }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300"
                            >
                                {{ $remain->created_at->format('d.m.Y') }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-4">
                    {{$remains->links()}}
                </div>
            @else
                <div role="alert"
                     class="mt-8 alert relative border rounded-md px-5 py-4 bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center">
                    <i data-tw-merge data-lucide="alert-circle"
                       class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
                    Нет данных
                </div>
            @endif
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/remains.js')
@endPushOnce
