@extends('layouts.sidebar')

@section('head')
    <title>Возврат товаров</title>
@endsection

@section('content')
    <h2 class="intro-y mt-5 text-lg font-medium">Изменение</h2>

    <div class="mt-5">
        <div class="intro-y col-span-12">
            <form id="return-form" action="{{ route('vendor.returns.clients.update', compact('return')) }}"
                  method="post">
                @csrf
                @method('PATCH')

                <div class="intro-y box p-5">
                    @include('vendor.returns.clients.partials.form')
                </div>

                <div class="intro-y box p-5 mt-3">
                    <h5 class="text-lg font-medium">Товары</h5>

                    <div class="overflow-x-auto">
                        <livewire:vendor.return.products :$return/>
                    </div>
                </div>

                <div class="mt-5 flex text-right gap-3">
                    <x-base.button
                        as="a"
                        :href="route('vendor.returns.clients.index')"
                        type="button"
                        variant="outline-primary"
                        class="mr-auto"
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
                    <livewire:vendor.return.finish :$return />
                </div>
            </form>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/returns.js')
@endPushOnce
