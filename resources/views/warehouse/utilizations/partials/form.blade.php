<div class="grid grid-cols-12 gap-3 gap-y-5">
    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="outlet_id">Торговая точка</x-base.form-label>
        <x-base.form-select
            id="outlet_id"
            name="outlet_id"
            aria-label=".form-select-lg example"
        >
            <option value="">Выберите торговую точку</option>
            @foreach($outlets as $outlet)
                <option
                    value="{{ $outlet->id }}"
                    @selected(old('outlet_id', $utilization->outlet_id) == $outlet->id)
                >{{ $outlet->name }}</option>
            @endforeach
        </x-base.form-select>

        @error('outlet_id')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-3">
        <x-base.form-label for="number">Номер</x-base.form-label>
        <x-base.form-input
            id="number"
            type="text"
            name="number"
            placeholder="Введите"
            value="{{ old('number', $utilization->number) }}"
        />

        @error('number')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-3">
        <x-base.form-label for="date">Дата</x-base.form-label>
        <div class="relative">
            <div
                class="absolute flex h-full w-10 items-center justify-center rounded-l border bg-slate-100 text-slate-500 dark:border-darkmode-800 dark:bg-darkmode-700 dark:text-slate-400">
                <x-base.lucide
                    class="h-4 w-4"
                    icon="Calendar"
                />
            </div>
            <x-base.litepicker
                id="date"
                class="pl-12"
                name="date"
                data-single-mode="true"
                value="{{ old('date', $utilization->date) }}"
            />
        </div>

        @error('date')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
