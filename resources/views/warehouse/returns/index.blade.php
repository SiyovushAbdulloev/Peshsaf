@extends('layouts.sidebar')

@section('subhead')
    <title>Возврат товаров</title>
@endsection

@section('content')
    <div class="mt-5">
        <h2 class="intro-y text-lg font-medium">Возврат товаров</h2>

        @if($returns->count())
            <table
                id="return-table"
                class="w-full text-left mt-5"
            >
                <thead>
                <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300
                [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50">
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        № н-й
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Статус
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Дата
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Торговая точка
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Адрес
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Телефон
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">
                        Количество
                    </th>
                    <th class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap w-[12%]">
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($returns as $return)
                    <tr class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                    >
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->number }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ __($return->status) }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->date->format('d.m.Y') }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->origin->name }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->origin->address }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->origin->phone }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300">{{ $return->products_count }}</td>
                        <td class="px-5 py-2 border-b dark:border-darkmode-300 gap-2 text-right">
                            <x-base.button
                                as="a"
                                size="sm"
                                href="{{ route('warehouse.returns.show', compact('return')) }}"
                                type="button"
                                :variant="$return->status()->is(\App\StateMachines\StatusReturn::PENDING) ? 'outline-warning' : 'outline-primary'"
                            >
                                @if($return->status()->is(\App\StateMachines\StatusReturn::PENDING))
                                    <x-base.icon icon="fa-check"/>
                                @else
                                    <x-base.icon icon="fa-info"/>
                                @endif
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
