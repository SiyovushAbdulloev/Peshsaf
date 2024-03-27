<div class="grid grid-cols-12 gap-3">
    <livewire:vendor.return.clients :$return/>

    <div class="grid grid-cols-subgrid col-span-12">
        <div class="col-span-6 2xl:col-span-3">
            <x-base.form-label for="number">Номер возврата</x-base.form-label>
            <x-base.form-input
                id="number"
                type="text"
                name="number"
                placeholder="Введите"
                value="{{ old('number', $return->number) }}"
            />

            @error('number')
            <div class="mt-2 text-danger italic">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="col-span-6 2xl:col-span-3">
            <x-base.form-label for="date">Дата</x-base.form-label>
            <div class="relative">
                <x-base.litepicker
                    name="date"
                    data-single-mode="true"
                    value="{{ old('date', $return->date) }}"
                />
            </div>
        </div>
    </div>
</div>
