@extends('layouts/sidebar')

@section('subhead')
    <title>Единицы измерений</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-10 text-lg font-medium">Создание</h2>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form action="{{ route('dictionaries.measurement-units.store') }}" method="post">
                @csrf

                <div class="intro-y box p-5">
                    @include('admin.dictionaries.measurement-units.partials.form')

                    <div class="mt-5 text-right">
                        <x-base.button
                            as="a"
                            :href="route('dictionaries.measurement-units.index')"
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
