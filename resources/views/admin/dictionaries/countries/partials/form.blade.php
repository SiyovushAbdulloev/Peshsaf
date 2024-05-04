<div class="grid grid-cols-2 gap-3">
    <div class="w-full">
        <x-base.form-label for="name">Наименование</x-base.form-label>
        <x-base.form-input
            id="name"
            type="text"
            name="name"
            placeholder="Введите наименование"
            value="{{ old('name', $country->name) }}"
        />

        @error('name')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="w-full">
        <x-base.form-label for="name">Код</x-base.form-label>
        <x-base.form-input
            id="code"
            type="text"
            name="code"
            placeholder="Введите код"
            value="{{ old('name', $country->code) }}"
        />

        @error('code')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <x-base.form-check class="mt-5">
        <x-base.form-check.input
            id="vertical-form-3"
            type="checkbox"
            name="is_favorite"
            checked="{{ old('is_favorite', $country->is_favorite) ? true : false }}"
            value="1"
        />
        <x-base.form-check.label for="vertical-form-3">
            Избранный
        </x-base.form-check.label>
    </x-base.form-check>

    @error('is_favorite')
    <div class="mt-2 text-danger italic">
        {{ $message }}
    </div>
    @enderror
</div>
