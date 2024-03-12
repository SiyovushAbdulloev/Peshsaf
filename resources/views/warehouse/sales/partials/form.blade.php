<div class="grid grid-cols-2 gap-3">
    <x-base.form-input
        type="hidden"
        name="client_id"
        value="{{ old('number', $client?->id) }}"
    />
    <div class="w-full">
        <x-base.form-label for="number">ФИО покупателя</x-base.form-label>
        <x-base.form-input
            id="number"
            type="text"
            name="client_name"
            placeholder="Введите"
            value="{{ old('number', $client?->name) }}"
        />

        @error('number')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <x-base.form-label for="name">Дата покупки</x-base.form-label>
        <div class="relative w-1/2">
            <x-base.litepicker
                name="date"
                data-single-mode="true"
                value="{{ old('date', $sale->date) }}"
            />
        </div>
    </div>
    <div class="w-full">
        <x-base.form-label for="number">Телефон</x-base.form-label>
        <x-base.form-input
            id="number"
            type="text"
            name="number"
            placeholder="Введите наименование"
            value="{{ old('number', $client?->name) }}"
        />

        @error('number')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
