@extends('layouts/sidebar')

@section('subhead')
    <title>Поставщики</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-10 text-lg font-medium">Поставщики</h2>
    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 mt-2 flex flex-wrap items-center ml-auto">
            <a href="{{ route('dictionaries.providers.create') }}" class="transition duration-200 border
            inline-flex items-center
            justify-center py-2
            px-3 rounded-md
            font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                Добавить
            </a>
        </div>

        @if($providers->count())
            <table
                data-tw-merge
                class="w-full text-left col-span-12"
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
                        Наименование организации
                    </th>
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        Адресс организации
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
                        Почта
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
                @foreach($providers as $provider)
                    <tr
                        data-tw-merge
                        class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                    >
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $provider->id }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $provider->organization_name }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $provider->organization_address }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $provider->phone }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $provider->email }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300 flex flex-row"
                        >
                            <a href="{{ route('dictionaries.providers.edit', compact('provider')) }}" class="mr-4">
                                <x-base.lucide icon="pencil"/>
                            </a>
                            <a href="#" class="text-danger">
                                <x-base.lucide icon="trash"/>
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
