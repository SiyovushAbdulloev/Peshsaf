@extends('layouts/sidebar')

@section('head')
    <title>Возврат товаров</title>
@endsection

@section('content')
    <h2 class="intro-y mt-5 text-lg font-medium">Создание</h2>

    <div class="mt-5">
        <div class="intro-y col-span-12">
            <form action="{{ route('vendor.returns-vendor.store') }}" method="post">
                @csrf

                <div class="intro-y box p-5">
                    @include('vendor.returns-vendor.partials.form')
                </div>

                <div class="intro-y box p-5 mt-3">
                    <h5 class="text-lg font-medium">Товары</h5>

                    <div class="overflow-x-auto">
                        <livewire:warehouse.movement.products/>
                    </div>
                </div>

                <div class="mt-5 text-right">
                    <x-base.button
                        as="a"
                        :href="route('vendor.returns-vendor.index')"
                        class="mr-1 w-24"
                        type="button"
                        variant="outline-primary"
                    >
                        Отмена
                    </x-base.button>
                    <x-base.button
                        type="button"
                        variant="primary"
                        type="submit"
                    >
                        Создать
                    </x-base.button>
                </div>
            </form>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/movements.js')
@endPushOnce
