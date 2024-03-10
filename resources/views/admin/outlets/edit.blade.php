@extends('layouts/sidebar')

@section('head')
    <title>Торговая точка</title>
@endsection

@section('content')
    <div class="intro-y mt-10 flex flex-row justify-content-between">
        <h2 class="intro-y text-lg font-medium">Изменение</h2>

        <form class="ml-auto" action="{{ route('admin.outlets.destroy', compact('outlet')) }}"
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

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12">
            <div class="intro-y box p-5">
                <form action="{{ route('admin.outlets.update', compact('outlet')) }}" method="post">
                    @csrf
                    @method('PATCH')

                    @include('admin.outlets.partials.form')

                    <div class="mt-5 ml-auto">
                        <x-base.button
                            as="a"
                            :href="route('admin.outlets.index')"
                            class="mr-1 w-24"
                            type="button"
                            variant="outline-secondary"
                        >
                            Отмена
                        </x-base.button>
                        <x-base.button
                            class="w-24"
                            variant="primary"
                            type="submit"
                        >
                            Сохранить
                        </x-base.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
