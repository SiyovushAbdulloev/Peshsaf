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
    <div class="mt-2 text-danger">
        {{ $message }}
    </div>
    @enderror
</div>
