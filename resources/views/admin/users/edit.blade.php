@extends('layouts/sidebar')

@section('head')
    <title>Пользователи</title>
@endsection

@section('content')
    <div class="intro-y mt-10 flex flex-row justify-content-between">
        <h2 class="intro-y text-lg font-medium">Изменение</h2>

        <form class="ml-auto" action="{{ route('admin.users.destroy', compact('user')) }}"
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
        <div class="intro-y col-span-12 lg:col-span-6">
            <form action="{{ route('admin.users.update', compact('user')) }}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="intro-y box p-5">
                    @include('admin.users.partials.form')

                    <div class="mt-5 text-right">
                        <x-base.button
                            as="a"
                            :href="route('admin.users.index')"
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
                            Изменить
                        </x-base.button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
