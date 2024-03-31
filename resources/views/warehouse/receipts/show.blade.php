@extends('layouts/sidebar')

@section('head')
    <title>Просмотр прихода</title>
@endsection

@section('content')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">Просмотр</h2>
    </div>

    <div class="intro-y mt-5 grid grid-cols-11 gap-5">
        <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
            <div class="box rounded-md p-5">
                <div class="mb-5 flex items-center border-b border-slate-200/60 pb-5 dark:border-darkmode-400">
                    <div class="truncate text-base font-medium">
                        Детали прихода
                    </div>
                </div>
                <div class="flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-user"
                    />
                    Поставщик: <span class="ml-2">{{ $receipt->supplier->name }}</span>
                </div>
                <div class="mt-3 flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-phone"
                    />
                    Номер накладной: <span class="ml-2">{{ $receipt->number }}</span>
                </div>
                <div class="mt-3 flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-location-dot"
                    />
                    Дата накладной: <span class="ml-2">{{ $receipt->date }}</span>
                </div>
                <div class="mt-3 flex items-center">
                    <x-base.icon
                        class="mr-1 h-4 w-4 text-slate-500"
                        icon="fa-location-dot"
                    />
                    Количество продуктов: <span class="ml-2">{{ $receipt->products_count }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
