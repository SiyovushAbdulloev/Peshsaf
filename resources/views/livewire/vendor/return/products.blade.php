<div>
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
            @forelse($selectedProducts ?? [] as $product)
                <x-base.table.tr wire:key="{{ $product->id }}">
                    <x-base.table.td>{{ $product->dicProduct->name }}</x-base.table.td>
                    <x-base.table.td>{{ $product->dicProduct->barcode }}</x-base.table.td>
                    <x-base.table.td>{{ $product->product->barcode }}</x-base.table.td>
                    <x-base.table.td>{{ $product->dicProduct->measure->name }}</x-base.table.td>
                    <x-base.table.td>
                        <input type="hidden" name="products[]" value="{{ $product->id }}">
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
                            wire:click="deleteProduct({{$product->id}})"
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
