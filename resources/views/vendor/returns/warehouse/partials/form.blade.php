<div class="grid grid-cols-12 gap-3">
    @if(!$return->exists)
        <div class="col-span-6 2xl:col-span-3">
            <x-base.form-label>Распределить по складам</x-base.form-label>
            <div class="flex gap-3">
                <x-base.form-check class="mr-2 mt-2 sm:mt-0">
                    <x-base.form-check.input
                        name="distribute"
                        type="radio"
                        value='1'
                        id="status-date"
                        :checked="old('distribute') == 1"
                    />
                    <x-base.form-check.label for="status-date">
                        Да
                    </x-base.form-check.label>
                </x-base.form-check>
                <x-base.form-check class="mr-2">
                    <x-base.form-check.input
                        name="distribute"
                        type="radio"
                        value="0"
                        id="no-limit"
                        :checked="old('distribute') == 0"
                    />
                    <x-base.form-check.label for="no-limit">
                        Нет
                    </x-base.form-check.label>
                </x-base.form-check>
            </div>
            @error('distribute')
            <div class="mt-2 text-danger italic">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-span-6 2xl:col-span-4">
            <div id="warehouse">
                <x-base.form-label for="warehouse_id">Склад</x-base.form-label>
                <x-base.form-select
                    id="warehouse_id"
                    name="warehouse_id"
                    aria-label=".form-select-lg example"
                >
                    <option value="">Выберите торговую точку</option>
                    @foreach($warehouses as $warehouse)
                        <option
                            value="{{ $warehouse->id }}" @selected(old('warehouse_id', $return->warehouse_id) == $warehouse->id)
                        >{{ $warehouse->name }}</option>
                    @endforeach
                </x-base.form-select>

                @error('warehouse_id')
                <div class="mt-2 text-danger italic">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    @endif
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
