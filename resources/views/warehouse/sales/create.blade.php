@extends('layouts/sidebar')

@section('head')
    <title>Продажа</title>
@endsection

@section('content')
    <h2 class="intro-y mt-10 text-lg font-medium">Создание</h2>

    <div class="mt-5">
        <div class="intro-y col-span-12">
            <form action="{{ route('warehouse.sales.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="intro-y box p-5">
                    @include('warehouse.sales.partials.form')
                </div>

                <div class="intro-y box p-5 mt-3">
                    <h5 class="text-lg font-medium">Товары</h5>

                    <div>
                        <livewire:warehouse.sale.products />
                    </div>
                </div>

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
                    <x-base.button
                        type="button"
                        variant="primary"
                        type="submit"
                    >
                        Оформить продажу
                    </x-base.button>
                </div>
            </form>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/sales.js')
@endPushOnce
