<div>
    <div class="w-full mb-2">
        <x-base.form-label for="name">Наименование</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="name"
            type="text"
            name="name"
            placeholder="Введите наименование"
            value="{{ old('name', $warehouse->name) }}"
        />

        @error('name')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="w-full mb-2">
        <x-base.form-label for="address">Адресс</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="address"
            type="text"
            name="address"
            placeholder="Введите адресс"
            value="{{ old('address', $warehouse->address) }}"
        />

        @error('address')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="w-full">
        <x-base.form-label for="phone">Телефон</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="phone"
            type="text"
            name="phone"
            placeholder="Введите телефон"
            value="{{ old('phone', $warehouse->phone) }}"
        />

        @error('phone')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
