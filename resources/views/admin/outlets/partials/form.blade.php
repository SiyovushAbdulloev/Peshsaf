<div class="grid grid-cols-12 gap-2">
    <div class="w-full mb-2 col-span-12">
        <x-base.form-label for="name">Наименование</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="name"
            type="text"
            name="name"
            placeholder="Введите наименование"
            value="{{ old('name', $outlet->name) }}"
        />

        @error('name')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="w-full mb-2 col-span-8">
        <x-base.form-label for="address">Адресс</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="address"
            type="text"
            name="address"
            placeholder="Введите адресс"
            value="{{ old('address', $outlet->address) }}"
        />

        @error('address')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="w-full col-span-4">
        <x-base.form-label for="phone">Телефон</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="phone"
            type="text"
            name="phone"
            placeholder="Введите телефон"
            value="{{ old('phone', $outlet->phone) }}"
        />

        @error('phone')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
