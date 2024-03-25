<div>
    <x-base.button
        size="sm"
        type="button"
        variant="outline-primary"
        class="text-right"
        wire:click="addProduct"
    >
        Сканировать
    </x-base.button>

    <x-base.table id="sale-products" class="mt-5">
        <x-base.table.thead variant="light">
            <x-base.table.tr>
                <x-base.table.th class="whitespace-nowrap">
                    Наименование
                </x-base.table.th>
                <x-base.table.th class="whitespace-nowrap">
                    Штрих-код
                </x-base.table.th>
                <x-base.table.th class="whitespace-nowrap">
                    QR код
                </x-base.table.th>
                <x-base.table.th class="whitespace-nowrap">
                    Ед. измерения
                </x-base.table.th>
                <x-base.table.th class="whitespace-nowrap">
                </x-base.table.th>
            </x-base.table.tr>
        </x-base.table.thead>
        <x-base.table.tbody>
            @forelse($selectedProducts ?? [] as $outletProduct)
                <x-base.table.tr wire:key="{{ $outletProduct->id }}">
                    <x-base.table.td>{{ $outletProduct->dicProduct->name }}</x-base.table.td>
                    <x-base.table.td>{{ $outletProduct->dicProduct->barcode }}</x-base.table.td>
                    <x-base.table.td>{{ $outletProduct->product->barcode }}</x-base.table.td>
                    <x-base.table.td>{{ $outletProduct->dicProduct->measure->name }}</x-base.table.td>
                    <x-base.table.td>
                        <input type="hidden" name="products[]" value="{{ $outletProduct->product_id }}">
                        <x-base.button
                            size="sm"
                            href="#"
                            type="button"
                            variant="outline-primary"
                        >
                            <x-base.icon icon="fa-info"></x-base.icon>
                        </x-base.button>
                        <x-base.button
                            size="sm"
                            class="delete-sale ml-1"
                            type="button"
                            variant="outline-danger"
                            wire:click="deleteProduct({{$outletProduct->id}})"
                        >
                            <x-base.icon icon="fa-trash"></x-base.icon>
                        </x-base.button>
                    </x-base.table.td>
                </x-base.table.tr>
            @empty
                <x-base.table.tr>
                    <x-base.table.td colspan="5" class="text-center">No data</x-base.table.td>
                </x-base.table.tr>
            @endforelse
        </x-base.table.tbody>
    </x-base.table>
</div>
