<div class="grid grid-cols-subgrid col-span-12">
    <div class="col-span-6 2xl:col-span-6">
        <x-base.form-label for="outlet_id">Тип</x-base.form-label>
        <x-base.form-select
            id="type"
            name="type"
            aria-label=".form-select-lg example"
            wire:change="change"
            wire:model="type"
        >
            @foreach([\App\Models\Utilization::OUTLET, \App\Models\Utilization::CLIENT] as $type)
                <option value="{{ $type }}" @selected(old('type', $utilization->type) == $type)>{{ __($type) }}</option>
            @endforeach
        </x-base.form-select>

        @error('type')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>
    @if($client)
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
    @else
        <div class="col-span-6 2xl:col-span-6">
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
    @endif
</div>
