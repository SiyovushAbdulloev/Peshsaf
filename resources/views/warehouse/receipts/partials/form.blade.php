<div class="grid grid-cols-3 gap-3">
    <div class="">
        <x-base.form-label for="supplier_id">Поставщик</x-base.form-label>
        <x-base.form-select
            id="supplier_id"
            name="supplier_id"
            aria-label=".form-select-lg example"
        >
            <option>Выберите поставщика</option>
            @foreach($suppliers as $supplier)
                <option
                    value="{{ $supplier->id }}" @selected(old('supplier_id', $receipt->supplier_id) == $supplier->id)
                >{{ $supplier->name }}</option>
            @endforeach
        </x-base.form-select>

        @error('supplier_id')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <x-base.form-label for="number">Номер накладной</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="number"
            type="text"
            name="number"
            placeholder="Введите наименование"
            value="{{ old('number', $receipt->number) }}"
        />

        @error('number')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div>
        <x-base.form-label for="name">Дата накладной</x-base.form-label>
        <div class="relative w-1/2">
            <x-base.litepicker
                name="date"
                data-single-mode="true"
                value="{{ old('date', $receipt->date) }}"
            />
        </div>
    </div>
</div>
