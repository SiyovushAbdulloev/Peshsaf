<div class="grid grid-cols-12 gap-3">
    @if($client?->image)
        <div class="col-span-12">
            <div class="image-fit relative h-20 w-20 flex-none sm:h-24 sm:w-24 lg:h-32 lg:w-32">
                <img class="rounded-full" src="{{ $client->image->url }}" alt="{{ $client->name }}">
                <div
                    class="absolute bottom-0 right-0 mb-1 mr-1 flex items-center justify-center rounded-full bg-primary p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         data-lucide="camera" class="lucide lucide-camera stroke-1.5 h-4 w-4 text-white">
                        <path
                            d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path>
                        <circle cx="12" cy="13" r="3"></circle>
                    </svg>
                </div>
            </div>
        </div>
    @endif
    <x-base.form-input
        type="hidden"
        name="client_id"
        value="{{ old('client_id', $client?->id) }}"
    />
    <div class="w-full col-span-10">
        <x-base.form-label for="client-name">ФИО покупателя</x-base.form-label>
        <x-base.form-input
            id="client-name"
            type="text"
            name="client_name"
            placeholder="Введите"
            value="{{ old('client_name', $client?->name) }}"
        />

        @error('client_name')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-2">
        <x-base.form-label for="date">Дата покупки</x-base.form-label>
        <div class="relative">
            <x-base.litepicker
                name="date"
                data-single-mode="true"
                value="{{ old('date', $sale->date) }}"
            />
        </div>
    </div>
    <div class="col-span-4">
        <x-base.form-label for="phone">Телефон</x-base.form-label>
        <x-base.form-input
            id="phone"
            type="text"
            name="client_phone"
            placeholder="Введите"
            value="{{ old('phone', $client?->phone) }}"
        />

        @error('phone')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-8">
        <x-base.form-label for="address">Адрес</x-base.form-label>
        <x-base.form-input
            id="address"
            type="text"
            name="client_address"
            placeholder="Введите"
            value="{{ old('address', $client?->address) }}"
        />

        @error('address')
        <div class="mt-2 text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    @if(!$client?->image)
        <div class="col-span-12">
            <x-base.form-label for="photo">Фото</x-base.form-label>
            <x-base.form-upload
                id="photo"
                name="client_photo"
                accept=".png,.jpg"
                description="PNG, JPG (макс 1Мб)"
            />

            @error('photo')
            <div class="mt-2 text-danger italic">
                {{ $message }}
            </div>
            @enderror
        </div>
    @endif
</div>
