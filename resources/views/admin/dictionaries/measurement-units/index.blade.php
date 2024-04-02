@extends('layouts/sidebar')

@section('head')
    <title>Единицы измерений</title>
@endsection

@section('content')
    <div class="mt-5">
        <div class="intro-y my-5 flex gap-4">
            <h2 class="intro-y text-lg font-medium">Единицы измерений</h2>

            <a href="{{ route('admin.dictionaries.measurement-units.create') }}" class="transition duration-200 border
            inline-flex items-center
            justify-center py-2
            px-3 rounded-md ml-auto
            font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">
                <x-base.icon icon="fa-plus" class="mr-2"/>
                Добавить
            </a>
        </div>

        <div class="box mt-5 p-4 overflow-x-auto">
            @if($units->count())
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
                            &nbsp;
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($units as $unit)
                        <tr
                            data-tw-merge
                            class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                        >
                            <td
                                data-tw-merge
                                class="px-5 py-3 border-b dark:border-darkmode-300"
                            >
                                {{ $unit->id }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-3 border-b dark:border-darkmode-300"
                            >
                                {{ $unit->name }}
                            </td>
                            <td
                                data-tw-merge
                                class="px-5 py-2 border-b dark:border-darkmode-300 gap-2 text-right"
                            >
                                <x-base.button
                                    as="a"
                                    size="sm"
                                    href="{{ route('admin.dictionaries.measurement-units.edit', compact('unit')) }}"
                                    type="button"
                                    variant="outline-success"
                                >
                                    <x-base.icon icon="fa-pen"/>
                                </x-base.button>
                                <x-base.button
                                    size="sm"
                                    type="button"
                                    class="delete"
                                    variant="outline-danger"
                                    data-route="{{ route('admin.dictionaries.measurement-units.destroy', compact('unit')) }}"
                                >
                                    <x-base.icon icon="fa-trash"/>
                                </x-base.button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div role="alert"
                     class="alert relative border rounded-md px-5 py-4 bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center">
                    <i data-tw-merge data-lucide="alert-circle"
                       class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
                    Нет данных
                </div>
            @endif
        </div>
    </div>

    <form id="delete-form" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
