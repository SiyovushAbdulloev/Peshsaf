<div class="grid grid-cols-12 gap-5 gap-y-5">
    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="name">Наименование</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="name"
            type="text"
            name="name"
            placeholder="Введите наименование"
            value="{{ old('name', $product->name) }}"
        />
        @error('name')
        <div class="font-italic text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label for="active-ingredient">Действующее вещество</x-base.form-label>
        <x-base.form-select
            id="active-ingredient"
            aria-label=".form-select-sm example"
            name="active_ingredient"
        >
            <option value="">Выберите действующее вещество</option>
            @foreach($activeIngredients as $activeIngredient)
                <option
                    value="{{$activeIngredient->id}}"
                    @selected(old('active_ingredient', $product->activeIngredient_id) == $activeIngredient->id)
                >
                    {{$activeIngredient->name}}
                </option>
            @endforeach
        </x-base.form-select>
        @error('active_ingredient')
        <div class="font-italic text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-6 2xl:col-span-4">
        <x-base.form-label for="status">Перечень</x-base.form-label>
        <x-base.form-select
            id="status"
            aria-label=".form-select-sm example"
            name="status"
        >
            <option value="">Выберите перечень</option>
            @foreach($list as $item)
                <option
                    value="{{$item['alias']}}"
                    @selected(old('status', $product->status) === $item['alias'])
                >
                    {{$item['description']}}
                </option>
            @endforeach
        </x-base.form-select>
        @error('status')
        <div class="font-italic text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-6 2xl:col-span-4">
        <x-base.form-label for="measure">Единица измерения</x-base.form-label>
        <x-base.form-select
            id="measure"
            aria-label=".form-select-sm example"
            name="measure"
        >
            <option value="">Выберите единицу</option>
            @foreach($measures as $measure)
                <option value="{{$measure->id}}" @selected(old('measure', $product->measure_id) == $measure->id)>
                    {{$measure->name}}
                </option>
            @endforeach
        </x-base.form-select>

        @error('measure')
        <div class="font-italic text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-6 2xl:col-span-2">
        <x-base.preview>
            <x-base.form-label>Срок действия</x-base.form-label>
            <div class="relative">
                <div
                    class="absolute flex h-full w-10 items-center justify-center rounded-l border bg-slate-100 text-slate-500 dark:border-darkmode-800 dark:bg-darkmode-700 dark:text-slate-400">
                    <x-base.lucide
                        class="h-4 w-4"
                        icon="Calendar"
                    />
                </div>
                <x-base.litepicker
                    class="pl-12"
                    data-single-mode="true"
                    id="status-date-picker"
                    value="{{old('expiry_date', $product->expiry_date)}}"
                    name="expiry_date"
                />
            </div>
        </x-base.preview>
        @error('expiry_date')
        <div class="font-italic text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-6 2xl:col-span-4">
        <x-base.form-label for="country">Страна</x-base.form-label>
        <x-base.form-select
            id="country"
            aria-label=".form-select-sm example"
            name="country"
        >
            <option value="">Выберите страну</option>
            <optgroup label="Избранные">
                @foreach($countries->where('is_favorite', true) as $favoriteCountry)
                    <option
                        value="{{$favoriteCountry->id}}"
                        @selected(old('country', $product->country_id) == $favoriteCountry->id)
                    >
                        {{$favoriteCountry->name}}
                    </option>
                @endforeach
            </optgroup>
            @foreach($countries->where('is_favorite', false) as $country)
                <option
                    value="{{$country->id}}"
                    @selected(old('country', $product->country_id) == $country->id)
                >
                    {{$country->name}}
                </option>
            @endforeach
        </x-base.form-select>
        @error('country')
        <div class="font-italic text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-6 2xl:col-span-4">
        <x-base.form-label for="barcode">Штрих-код</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="barcode"
            type="text"
            name="barcode"
            placeholder="Введите штрих-код"
            value="{{ old('barcode', $product->barcode) }}"
        />
        @error('barcode')
        <div class="font-italic text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-span-12">
        <x-base.form-label for="description">Общая информация</x-base.form-label>
        <x-base.form-textarea
            class="w-full"
            id="description"
            type="text"
            name="description"
            placeholder="Введите информацию о товаре"
            rows="6"
        >
            {{ old('description', $product->description) }}
        </x-base.form-textarea>
        @error('description')
        <div class="font-italic text-danger italic">
            {{ $message }}
        </div>
        @enderror
    </div>

    <livewire:files :files="$product->files"/>
</div>

@pushOnce('scripts')
    @vite('resources/js/pages/project/products.js')
@endPushOnce
