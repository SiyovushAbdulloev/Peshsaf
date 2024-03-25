@extends('layouts/sidebar')

@section('head')
    <title>Возврат товаров</title>
@endsection

@section('content')
    <div class="intro-y mt-10 flex flex-row justify-content-between">
        <h2 class="intro-y text-lg font-medium">Изменение</h2>

        <form class="ml-auto" action="{{ route('vendor.returns-vendor.destroy', compact('return')) }}"
              method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
            @csrf
            @method('DELETE')

            <x-base.button
                class="w-24"
                variant="danger"
                type="submit"
            >
                Удалить
            </x-base.button>
        </form>
    </div>

    <div class="mt-5">
        <div class="intro-y col-span-12">
            <form action="{{ route('vendor.returns-vendor.update', compact('return')) }}" method="post">
                @csrf
                @method('PATCH')

                <livewire:vendor.return.clients :$return/>

                <div class="intro-y box p-5 mt-2">
                    @include('vendor.returns-vendor.partials.form')
                </div>

                <div class="intro-y box p-5 mt-3">
                    <h5 class="text-lg font-medium">Товары</h5>

                    <div class="overflow-x-auto">
                        <livewire:vendor.return.products :$return/>
                    </div>
                </div>

                <div class="mt-5 text-right gap-3">
                    <x-base.button
                        as="a"
                        :href="route('vendor.returns-vendor.index')"
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
                    <livewire:vendor.return.send :$return/>
                </div>
            </form>
        </div>
    </div>
@endsection

@pushOnce('scripts')
    @vite('resources/js/pages/project/movements.js')
@endPushOnce
