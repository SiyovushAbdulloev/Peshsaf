<div class="grid grid-cols-2 gap-4">
    <div class="w-full">
        <x-base.form-label for="organization_name">Наименование</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="organization_name"
            type="text"
            name="organization_name"
            placeholder="Введите наименование организации"
            value="{{ old('organization_name', $supplier->organization_name) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('organization_name')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="full_name">ФИО</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="full_name"
            type="text"
            name="full_name"
            placeholder="Введите ФИО поставщика"
            value="{{ old('full_name', $supplier->full_name) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('full_name')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="country">Страна</x-base.form-label>
        <x-base.form-select
            id="country"
            class="mt-2"
            formSelectSize="md"
            aria-label=".form-select-sm example"
            name="country"
        >
            <option value="">Выберите страну</option>
            @foreach($countries as $country)
                <option
                    value="{{$country->id}}"
                    @selected(old('country', $supplier->country?->id) == $country->id)
                >
                    {{$country->name}}
                </option>
            @endforeach
        </x-base.form-select>
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('country')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full flex flex-col justify-between">
        <x-base.form-label for="organization_address">Адрес</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="organization_address"
            type="text"
            name="organization_address"
            placeholder="Введите адрес организации"
            value="{{ old('organization_address', $supplier->organization_address) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('organization_address')
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
            value="{{ old('phone', $supplier->phone) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('phone')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="email">Почта</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="email"
            type="email"
            name="email"
            placeholder="Введите почту"
            value="{{ old('email', $supplier->email) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('email')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="description">Общая информация</x-base.form-label>
        <x-base.form-textarea
            class="w-full"
            id="description"
            type="text"
            name="description"
            placeholder="Введите информацию об организации"
        >
            {{ old('description', $supplier->description) }}
        </x-base.form-textarea>
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('description')
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

        @if($supplier->exists())
            <div>
                <table>
                    @foreach($supplier->files as $file)
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
    @vite('resources/js/pages/suppliers.js')
@endPushOnce
