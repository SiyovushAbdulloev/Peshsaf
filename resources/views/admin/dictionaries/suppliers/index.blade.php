@extends('layouts/sidebar')

@section('head')
    <title>Поставщики</title>
@endsection

@section('content')
    <h2 class="intro-y mt-5 text-lg font-medium">Поставщики</h2>

    <div class="overflow-x-auto">
        <div class="intro-y col-span-12 mt-2 mb-2 flex flex-wrap items-center ml-auto w-fit">
            <a href="{{ route('admin.dictionaries.suppliers.create') }}" class="transition duration-200 border
            inline-flex items-center
            justify-center py-2
            px-3 rounded-md
            font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                Добавить
            </a>
        </div>

        @if($suppliers->count())
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
                        Адресс
                    </th>
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        Телефон
                    </th>
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        E-mail
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
                @foreach($suppliers as $supplier)
                    <tr
                        data-tw-merge
                        class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                    >
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $supplier->id }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $supplier->organization_name }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $supplier->organization_address }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $supplier->phone }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $supplier->email }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300 flex flex-row"
                        >
                            <a href="{{ route('admin.dictionaries.suppliers.edit', compact('supplier')) }}"
                               class="mr-4">
                                <x-base.icon icon="fa-pen-to-square fa-solid"/>
                            </a>
                            <a href="#" class="text-danger">
                                <x-base.icon icon="fa-trash"></x-base.icon>
                            </a>
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
