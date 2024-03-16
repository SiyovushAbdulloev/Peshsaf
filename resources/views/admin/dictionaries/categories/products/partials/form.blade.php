<div class="flex" style="flex-wrap: wrap">
    <div class="w-1/2 mr-2">
        <x-base.form-label for="name">Наименование</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="name"
            type="text"
            name="name"
            placeholder="Введите наименование"
            value="{{ old('name', $product->name) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('name')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div style="width: 49%">
        <x-base.form-label for="active-ingredient">Действующее вещество</x-base.form-label>
        <x-base.form-select
            id="active-ingredient"
            class="mt-2"
            formSelectSize="sm"
            aria-label=".form-select-sm example"
            name="active_ingredient"
        >
            <option value="">Выберите действующее вещество</option>
            @foreach($activeIngredients as $activeIngredient)
                <option value="{{$activeIngredient->id}}"
                    {{
                        $product->exists ?
                        ($product->activeIngredient?->id === $activeIngredient->id ? 'selected' : '') :
                        (old('active_ingredient') == $activeIngredient->id ? 'selected' : '')
                    }}
                >{{$activeIngredient->name}}</option>
            @endforeach
        </x-base.form-select>
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('active_ingredient')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div style="width: 33%" class="mr-2">
        <x-base.form-label for="status">Перечень</x-base.form-label>
        <x-base.form-select
            id="status"
            class="mt-2"
            formSelectSize="sm"
            aria-label=".form-select-sm example"
            name="status"
        >
            <option value="">Выберите перечень</option>
            @foreach($list as $item)
                <option value="{{$item['alias']}}"
                    {{
                        $product->status ?
                        ($product->status === $item['alias'] ? 'selected' : '') :
                        (old('status') === $item['alias'] ? 'selected' : '')
                    }}
                >{{$item['description']}}</option>
            @endforeach
        </x-base.form-select>
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('status')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div style="width: 33%" class="mr-2">
        <x-base.form-label for="measure">Единицы измерения</x-base.form-label>
        <x-base.form-select
            id="measure"
            class="mt-2"
            formSelectSize="sm"
            aria-label=".form-select-sm example"
            name="measure"
        >
            <option value="">Выберите единицу</option>
            @foreach($measures as $measure)
                <option value="{{$measure->id}}"
                    {{
                        $product->exists ?
                        ($product->measure?->id === $measure->id ? 'selected' : '') :
                        (old('measure') == $measure->id ? 'selected' : '')
                    }}
                >{{$measure->name}}</option>
            @endforeach
        </x-base.form-select>
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('measure')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div style="width: 32%">
        <x-base.preview>
            <div class="relative mx-auto w-56">
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
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('expiry_date')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div style="width: 69%" class="mr-2">
        <x-base.form-label for="country">Страна</x-base.form-label>
        <x-base.form-select
            id="country"
            class="mt-2"
            formSelectSize="sm"
            aria-label=".form-select-sm example"
            name="country"
        >
            <option value="">Выберите страну</option>
            @foreach($countries as $country)
                <option value="{{$country->id}}"
                    {{
                        $product->exists ?
                        ($product->country?->id === $country->id ? 'selected' : '') :
                        (old('country') == $country->id ? 'selected' : '')
                    }}
                >{{$country->name}}</option>
            @endforeach
        </x-base.form-select>
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('country')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div style="width: 30%">
        <x-base.form-label for="barcode">Штрих-код</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="barcode"
            type="text"
            name="barcode"
            placeholder="Введите штрих-код"
            value="{{ old('barcode', $product->barcode) }}"
        />
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('barcode')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="description">Общая информация</x-base.form-label>
        <x-base.form-textarea
            class="w-full"
            id="description"
            type="text"
            name="description"
            placeholder="Введите информацию о товаре"
        >
            {{ old('description', $product->description) }}
        </x-base.form-textarea>
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('description')
            {{ $message }}
            @enderror
        </h5>
    </div>

    <div class="w-full flex flex-col gap-8">
        <input
            type="file"
            name="files[]"
            placeholder="Нажмите чтобы выбрать файл"
            multiple="multiple"
            accept=".doc,.pdf"
        />

        @if($product->exists())
            <div>
                <table>
                    @foreach($product->files as $file)
                        <tr id="{{$file->id}}">
                            <td>
                                {{$file->original_filename}}
                            </td>
                            <td>
                                <x-base.button
                                    class="w-20"
                                    variant="danger"
                                    type="button"
                                    data-value="{{$file->id}}"
                                    id="remove-file"
                                >
                                    Удалить
                                </x-base.button>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('files')
            {{ $message }}
            @enderror
            @if ($errors->has('files.*'))
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->get('files.*') as $error)
                            @foreach($error as $message)
                                <p>{{ $message }}</p>
                            @endforeach
                        @endforeach
                    </ul>
                </div>
            @endif
        </h5>
    </div>
</div>
@pushOnce('scripts')
    @vite('resources/js/pages/project/products.js')
@endPushOnce
