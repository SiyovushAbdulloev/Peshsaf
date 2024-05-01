<div class="grid grid-cols-12 gap-2 gap-y-5">
    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="name">ФИО пользователя</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="name"
            type="text"
            name="name"
            placeholder="Введите ФИО"
            value="{{ old('name', $user->name) }}"
        />
        @error('name')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="position">Должность</x-base.form-label>
        <x-base.form-select
            aria-label="form-select-sm example"
            name="position"
        >
            <option value="">Выберите позицию</option>
            @foreach($positions as $p)
                <option
                    value="{{$p->id}}"
                    @selected(old('position', $user->position?->id) == $p->id)
                >
                    {{$p->name}}
                </option>
            @endforeach
        </x-base.form-select>
        @error('position')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="address">Адресс</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="address"
            type="text"
            name="address"
            placeholder="Введите адресс"
            value="{{ old('address', $user->address) }}"
        />
        @error('address')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label>Статус</x-base.form-label>
        <div class="flex flex-row">
            <x-base.form-check class="mr-2">
                <x-base.form-check.input
                    name="is_limited"
                    type="radio"
                    value="0"
                    id="no-limit"
                    :checked="old('is_limited', $user->is_limited) == 0"
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
                    :checked="old('is_limited', $user->is_limited) == 1"
                />
                <x-base.form-check.label for="status-date">
                    Активен до
                </x-base.form-check.label>
                <div class="relative ml-3">
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
                        :disabled="!$user->is_limited"
                    />
                </div>
            </x-base.form-check>
        </div>
        @error('is_limited')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
        @error('expired')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <livewire:admin.users.form :user="$user"/>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="phone">Телефон</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="phone"
            type="text"
            name="phone"
            placeholder="Введите телефон"
            value="{{ old('phone', $user->phone) }}"
        />
        @error('phone')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="email">E-mail</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="email"
            type="email"
            name="email"
            placeholder="Введите e-mail"
            value="{{ old('email', $user->email) }}"
        />
        @error('email')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="password">Пароль</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="password"
            type="password"
            name="password"
            placeholder="Введите пароль"
        />
        @error('password')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="password-confirmation">Подтвердите пароль</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="password-confirmation"
            type="password"
            name="password_confirmation"
            placeholder="Введите пароль"
        />
    </div>

    <livewire:files :files="$user->files" />
</div>

@pushOnce('scripts')
    @vite('resources/js/pages/project/users.js')
@endPushOnce
