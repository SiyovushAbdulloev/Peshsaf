@extends('layouts/sidebar')

@section('head')
    <title>Продажа</title>
@endsection

@section('content')
    <h2 class="intro-y mt-10 text-lg font-medium">Создание</h2>

    <div class="mt-5">
        <div class="intro-y col-span-12">
            <form action="{{ route('warehouse.sales.store') }}" method="post">
                @csrf

                <div class="intro-y box p-5">
                    @include('warehouse.sales.partials.form')

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
                            class="w-24"
                            type="button"
                            variant="primary"
                            type="submit"
                        >
                            Добавить
                        </x-base.button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/sales.js')
@endPushOnce
