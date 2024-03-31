<div class="grid grid-cols-12 gap-3 gap-y-5">
    <div class="col-span-6 2xl:col-span-6">
        <x-base.form-label for="outlet_id">Клиент</x-base.form-label>
        <x-base.form-select
            id="client_id"
            name="client_id"
            aria-label=".form-select-lg example"
        >
            <option value="">Выберите клиента</option>
            @foreach($clients as $client)
                <option
                    value="{{ $client->id }}"
                    @selected(old('client_id', $utilization->client_id) == $client->id)
                >{{ $client->name }}</option>
            @endforeach
        </x-base.form-select>

        @error('client_id')
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
