@extends('layouts/sidebar')

@section('subhead')
    <title>Действующие вещества</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-10 flex flex-row justify-content-between">
        <h2 class="intro-y text-lg font-medium">Изменение</h2>

        <form class="ml-auto" action="{{ route('admin.dictionaries.substances.destroy', compact('substance')) }}"
              method="post" onsubmit="return confirm('Вы действительно хотите удалить?');">
            @csrf
            @method('DELETE')

            <x-base.button
                class="w-24"
                type="button"
                variant="danger"
                type="submit"
            >
                Удалить
            </x-base.button>
        </form>
    </div>

    <div class="mt-5 grid grid-cols-12 gap-6">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form action="{{ route('admin.dictionaries.substances.update', compact('substance')) }}" method="post">
                @csrf
                @method('PATCH')

                <div class="intro-y box p-5">
                    @include('admin.dictionaries.substances.partials.form')

                    <div class="mt-5 text-right">
                        <x-base.button
                            as="a"
                            :href="route('admin.dictionaries.substances.index')"
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
                            Изменить
                        </x-base.button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
