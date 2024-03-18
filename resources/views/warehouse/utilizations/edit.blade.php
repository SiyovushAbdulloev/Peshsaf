@extends('layouts/sidebar')

@section('head')
    <title>Утилизация товаров</title>
@endsection

@section('content')
    <h2 class="intro-y mt-5 text-lg font-medium">Изменение</h2>

    <div class="mt-5">
        <div class="intro-y col-span-12">
            <form action="{{ route('warehouse.utilizations.update', compact('utilization')) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="intro-y box p-5">
                    @include('warehouse.utilizations.partials.form')
                </div>

                <div class="intro-y box p-5 mt-3">
                    <h5 class="text-lg font-medium">Товары</h5>

                    <div class="overflow-x-auto">
                        <livewire:warehouse.utilization.products :$utilization />
                    </div>
                </div>

                <div class="mt-5 text-right gap-3">
                    <x-base.button
                        as="a"
                        :href="route('warehouse.utilizations.index')"
                        class="w-24"
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
                        Изменить
                    </x-base.button>
                    <livewire:warehouse.utilization.finish :$utilization />
                </div>
            </form>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/utilizations.js')
@endPushOnce
