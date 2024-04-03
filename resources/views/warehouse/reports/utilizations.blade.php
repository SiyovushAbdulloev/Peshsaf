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

            <div class="box p-4 mt-8">
                <div class="grid grid-cols-12 gap-4">
                    <x-base.form-select
                        class="col-span-6"
                        aria-label="form-select-sm example"
                        name="outlet"
                        id="outlet"
                    >
                        <option value="">Выберите торговую точку</option>
                        @foreach($outlets as $outlet)
                            <option value="{{$outlet->id}}" @selected(($filters['outlet'] ?? 0) == $outlet->id)>
                                {{$outlet->name}}
                            </option>
                        @endforeach
                    </x-base.form-select>
                    <x-base.form-input
                        class="col-span-6"
                        id="client"
                        type="text"
                        name="client"
                        placeholder="Введите имя клиента"
                        value="{{ request()->get('client') }}"
                    />
                </div>
                <div class="grid grid-cols-12 gap-4 mt-4">
                    <x-base.form-select
                        class="col-span-6 2xl:col-span-2"
                        aria-label="form-select-sm example"
                        id="option"
                        name="option"
                    >
                        <option value="">Выберите дату</option>
                        @foreach($options as $option)
                            <option
                                value="{{ $option['value'] }}"
                                data-from="{{ $option['from'] }}"
                                @selected(request()->get('option') == $option['value'])
                                data-to="{{$option['to']}}"
                            >
                                {{$option['label']}}
                            </option>
                        @endforeach
                    </x-base.form-select>
                    <x-base.litepicker
                        class="col-span-6 2xl:col-span-2"
                        data-single-mode="true"
                        id="from"
                        name="from"
                        data-set-date="false"
                        placeholder="Дата начала"
                        value="{{ request()->get('from') }}"
                    />
                    <x-base.litepicker
                        class="col-span-6 2xl:col-span-2"
                        data-single-mode="true"
                        id="to"
                        name="to"
                        data-set-date="false"
                        placeholder="Дата окончания"
                        value="{{ request()->get('to') }}"
                    />
                    <div class="flex gap-4 col-span-6 ml-auto">
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
                            type="button"
                        >
                            Очистить
                        </x-base.button>
                    </div>
                </div>
            </div>
        </form>

        <div class="box p-4 mt-6 overflow-x-auto">
            <x-base.button
                class="flex gap-2 ml-auto"
                variant="outline-success"
                id="export-btn"
                type="button"
            >
                <x-base.icon icon="fa-file-excel"/>
                <span>Экспорт</span>
            </x-base.button>
            @if($utilizationProducts->count())
                <table
                    id="sales-table"
                    class="w-full text-left"
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
                <div class="mt-4">
                    {{$utilizationProducts->links()}}
                </div>
            @else
                <div role="alert"
                     class="mt-8 alert relative border rounded-md px-5 py-4 bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center">
                    <i data-lucide="alert-circle" class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
                    Нет данных
                </div>
            @endif
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/reports.js')
@endPushOnce
