<div class="grid grid-cols-3 gap-3">
    <div class="">
        <x-base.form-label for="supplier_id">Поставщик</x-base.form-label>
        <x-base.form-select
            id="supplier_id"
            name="supplier_id"
            aria-label=".form-select-lg example"
        >
            @foreach($suppliers as $supplier)
                <option>Выберите поставщика</option>
                <option value="{{ $supplier->id }}" @selected(old('supplier_id', $receipt->supplier_id) == $supplier->id)
                >{{ $supplier->name }}</option>
            @endforeach
        </x-base.form-select>

        @error('supplier_id')
        <div class="mt-2 text-danger">
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
        <div class="mt-2 text-danger">
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

<x-base.table id="receipts" class="mt-5">
    <x-base.table.thead variant="light">
        <x-base.table.tr>
            <x-base.table.th class="whitespace-nowrap">#</x-base.table.th>
            <x-base.table.th class="whitespace-nowrap">
                Наименование
            </x-base.table.th>
            <x-base.table.th class="whitespace-nowrap">
                Штрих-код
            </x-base.table.th>
            <x-base.table.th class="whitespace-nowrap">
                Ед. измерения
            </x-base.table.th>
            <x-base.table.th class="whitespace-nowrap">
            </x-base.table.th>
        </x-base.table.tr>
    </x-base.table.thead>
    <x-base.table.tbody>
        @foreach($products as $product)
            <x-base.table.tr>
                <x-base.table.td>
                    <x-base.form-check.input
                        class="products"
                        type="checkbox"
                        name="products[]"
                        :checked="in_array($product->id, old('products') ?? [])"
                        value="{{ $product->id }}"
                    />
                </x-base.table.td>
                <x-base.table.td>{{ $product->name }}</x-base.table.td>
                <x-base.table.td>{{ $product->barcode }}</x-base.table.td>
                <x-base.table.td>{{ $product->measure->name }}</x-base.table.td>
                <x-base.table.td>
                    <a href="#" class="mr-4">
                        <x-base.lucide icon="info" />
                    </a>
                </x-base.table.td>
            </x-base.table.tr>
        @endforeach
    </x-base.table.tbody>
</x-base.table>

<h2 class="text-lg mt-4 ml-5">
    Количество выбранных товаров <span id="selected" class="font-bold text-xl">0</span> из <span class="font-bold
    text-xl">{{
    $products->count() }}</span>
</h2>
