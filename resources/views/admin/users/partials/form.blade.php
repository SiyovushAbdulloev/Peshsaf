<div class="grid grid-cols-2 gap-4">
    <div class="w-full">
        <x-base.form-label for="name">ФИО пользователя</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="name"
            type="text"
            name="name"
            placeholder="Введите ФИО"
            value="{{ old('name', $user->name) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('name')
            {{ $message }}
            @enderror
        </h5>
    </div>
    <div class="w-full">
        <x-base.form-label for="address">Адресс</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="address"
            type="text"
            name="address"
            placeholder="Введите адресс"
            value="{{ old('address', $user->address) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('address')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="position">Позиция</x-base.form-label>
        <x-base.form-select
            class="mt-2"
            formSelectSize="md"
            aria-label="form-select-sm example"
            name="position"
        >
            @foreach($positions as $position)
                <option
                    value="{{$position->id}}"
                    {{
                        $user->exists ?
                        ($user->position?->id === $position->id ? 'selected' : '') :
                        (old('position') == $position->id ? 'selected' : '')
                    }}
                >{{$position->name}}</option>
            @endforeach
        </x-base.form-select>
    </div>

    <div class="mt-2 flex flex-col">
        <x-base.form-label style="opacity: 0;">Статус</x-base.form-label>
        <div class="flex flex-row">
            <x-base.form-check class="mr-2">
                <x-base.form-check.input
                    name="is_limited"
                    type="radio"
                    value='0'
                    id="no-limit"
                    checked="{{$user->exists ? (!$user->is_limited ? '1' : '0') : (old('is_limited') ? '0' : '1')}}"
                />
                <x-base.form-check.label for="no-limit">
                    Нет ограничения
                </x-base.form-check.label>
            </x-base.form-check>
            <x-base.form-check class="mr-2 mt-2 sm:mt-0">
                <x-base.form-check.input
                    name="is_limited"
                    type="radio"
                    value='1'
                    id="status-date"
                    checked="{{$user->exists ? ($user->is_limited ? '1' : '0') : (old('is_limited') ? '1' : '0')}}"
                />
                <x-base.form-check.label for="status-date">
                    <x-base.preview>
                        <div class="relative mx-auto w-56">
                            <div
                                class="absolute flex h-full w-10 items-center justify-center rounded-l border bg-slate-100 text-slate-500 dark:border-darkmode-800 dark:bg-darkmode-700 dark:text-slate-400">
                                <x-base.lucide
                                    class="h-4 w-4"
                                    icon="Calendar"
                                />
                            </div>
                            <x-base.litepicker
                                class="pl-12"
                                data-single-mode="true"
                                id="status-date-picker"
                                value="{{old('expired', $user->expired)}}"
                                name="expired"
                            />
                        </div>
                    </x-base.preview>
                </x-base.form-check.label>
            </x-base.form-check>
        </div>
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('is_limited')
            {{ $message }}
            @enderror
            @error('expired')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="phone">Телефон</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="phone"
            type="text"
            name="phone"
            placeholder="Введите телефон"
            value="{{ old('phone', $user->phone) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('phone')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="password">Пароль</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="password"
            type="text"
            name="password"
            placeholder="Введите пароль"
            value="{{ old('password', '') }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('password')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="email">E-mail</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="email"
            type="email"
            name="email"
            placeholder="Введите e-mail"
            value="{{ old('email', $user->email) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('email')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full flex flex-col gap-8">
        <input
            type="file"
            name="files[]"
            placeholder="Нажмите чтобы выбрать файл"
            multiple="multiple"
            accept=".doc,.pdf,.txt"
        />

        @if($user->exists())
            <div>
                <table>
                    @foreach($user->files as $file)
                        <tr id="{{$file->id}}">
                            <td>
                                {{$file->original_filename}}
                            </td>
                            <td>
                                <x-base.button
                                    class="w-20"
                                    variant="danger"
                                    type="button"
                                    data-value="{{$file->id}}"
                                    id="remove-file"
                                >
                                    Удалить
                                </x-base.button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('files')
            {{ $message }}
            @enderror
        </h5>
    </div>
</div>
@pushOnce('scripts')
    @vite('resources/js/pages/users.js')
@endPushOnce
