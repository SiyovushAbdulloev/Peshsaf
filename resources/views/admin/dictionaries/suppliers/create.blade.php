@extends('layouts/sidebar')

@section('head')
    <title>Поставщики</title>
@endsection

@section('content')
    <h2 class="intro-y mt-10 text-lg font-medium">Создание</h2>

    <div class="mt-5 gap-6">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form action="{{ route('admin.dictionaries.suppliers.store') }}" method="post"
                  enctype="multipart/form-data">
                @csrf

                <div class="intro-y box p-5">
                    @include('admin.dictionaries.suppliers.partials.form')

                    <div class="mt-5 text-right">
                        <x-base.button
                            as="a"
                            :href="route('admin.dictionaries.suppliers.index')"
                            class="mr-1 w-24"
                            type="button"
                            variant="outline-secondary"
                        >
                            Отмена
                        </x-base.button>
                        <x-base.button
                            type="submit"
                            id="store-provider"
                            variant="primary"
                        >
                            Добавить
                        </x-base.button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
