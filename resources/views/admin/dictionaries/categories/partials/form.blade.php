<div>
    <x-base.form-label for="name">Наименование</x-base.form-label>
    <x-base.form-input
        class="w-full"
        id="name"
        type="text"
        name="name"
        placeholder="Введите наименование"
        value="{{ old('name', $category->name) }}"
    />

    @error('name')
    <div class="mt-2 text-danger italic">
        {{ $message }}
    </div>
    @enderror

    <x-base.form-label for="name">Код</x-base.form-label>
    <x-base.form-input
        class="w-full"
        id="code"
        type="text"
        name="code"
        placeholder="Введите код"
        value="{{ old('name', $category->code) }}"
    />

    @error('code')
    <div class="mt-2 text-danger italic">
        {{ $message }}
    </div>
    @enderror
</div>
