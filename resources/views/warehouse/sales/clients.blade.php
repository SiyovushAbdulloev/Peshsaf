@extends('layouts/sidebar')

@section('head')
    <title>Продажа</title>
@endsection

@section('content')
    <h2 class="intro-y mt-10 text-lg font-medium">Создание</h2>

    <div class="mt-5">
        <div class="intro-y col-span-12">
            <livewire:warehouse.sale.clients />

            <div class="mt-5 text-right">
                <x-base.button
                    as="a"
                    :href="route('warehouse.sales.index')"
                    class="mr-1 w-24"
                    type="button"
                    variant="outline-secondary"
                >
                    Отмена
                </x-base.button>
            </div>
        </div>
    </div>
@endsection
