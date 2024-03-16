<div class="grid grid-cols-12 gap-3">
    <div class="w-full col-span-6">
        <x-base.form-label for="outlet_id">Торговая точка</x-base.form-label>
        <x-base.form-select
            id="outlet_id"
            name="outlet_id"
            aria-label=".form-select-lg example"
        >
            <option>Выберите торговую точку</option>
            @foreach($outlets as $outlet)
                <option value="{{ $outlet->id }}" @selected(old('outlet_id', $movement->outlet_id) == $outlet->id)
                >{{ $outlet->name }}</option>
            @endforeach
        </x-base.form-select>

        @error('outlet_id')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="w-full col-span-3">
        <x-base.form-label for="number">Номер накладной</x-base.form-label>
        <x-base.form-input
            id="number"
            type="text"
            name="number"
            placeholder="Введите"
            value="{{ old('number', $movement->number) }}"
        />

        @error('number')
        <div class="mt-2 text-danger">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-3">
        <x-base.form-label for="date">Дата накладной</x-base.form-label>
        <div class="relative">
            <x-base.litepicker
                name="date"
                data-single-mode="true"
                value="{{ old('date', $movement->date) }}"
            />
        </div>
    </div>
</div>
