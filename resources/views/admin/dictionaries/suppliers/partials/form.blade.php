<div class="grid grid-cols-12 gap-5 gap-y-5">
    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="organization_name">Наименование</x-base.form-label>
        <x-base.form-input
            id="organization_name"
            type="text"
            name="organization_name"
            placeholder="Введите наименование организации"
            value="{{ old('organization_name', $supplier->organization_name) }}"
        />
        @error('organization_name')
        <div class="font-italic text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="full_name">ФИО</x-base.form-label>
        <x-base.form-input
            id="full_name"
            type="text"
            name="full_name"
            placeholder="Введите ФИО поставщика"
            value="{{ old('full_name', $supplier->full_name) }}"
        />
        @error('full_name')
        <div class="font-italic text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="country">Страна</x-base.form-label>
        <x-base.form-select
            id="country"
            aria-label=".form-select-sm example"
            name="country"
        >
            <option value="">Выберите страну</option>
            @foreach($countries as $country)
                <option
                    value="{{$country->id}}"
                    @selected(old('country', $supplier->country_id) == $country->id)
                >
                    {{ $country->name }}
                </option>
            @endforeach
        </x-base.form-select>
        @error('country')
        <div class="font-italic text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="organization_address">Адрес</x-base.form-label>
        <x-base.form-input
            id="organization_address"
            type="text"
            name="organization_address"
            placeholder="Введите адрес организации"
            value="{{ old('organization_address', $supplier->organization_address) }}"
        />
        @error('organization_address')
        <div class="font-italic text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="phone">Телефон</x-base.form-label>
        <x-base.form-input
            id="phone"
            type="text"
            name="phone"
            placeholder="Введите телефон"
            value="{{ old('phone', $supplier->phone) }}"
        />
        @error('phone')
        <div class="font-italic text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="email">Почта</x-base.form-label>
        <x-base.form-input
            id="email"
            type="email"
            name="email"
            placeholder="Введите почту"
            value="{{ old('email', $supplier->email) }}"
        />
        @error('email')
        <div class="font-italic text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12">
        <x-base.form-label for="description">Общая информация</x-base.form-label>
        <x-base.form-textarea
            id="description"
            type="text"
            name="description"
            rows="6"
            placeholder="Введите информацию об организации"
        >
            {{ old('description', $supplier->description) }}
        </x-base.form-textarea>
        @error('description')
        <div class="font-italic text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12">
        <x-base.form-label for="files">Загрузите документы</x-base.form-label>
        <x-base.form-upload
            id="files"
            name="files"
            :multiple="true"
            accept=".doc,.pdf"
            description="PDF, DOC (макс 1Мб)"
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
        @error('files')
        <div class="font-italic text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
@pushOnce('scripts')
    @vite('resources/js/pages/suppliers.js')
@endPushOnce
