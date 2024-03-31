<div>
    <div class="intro-y mt-2 flex">
        <h2 class="intro-y text-lg font-medium">Список товаров</h2>

        <x-base.button
            as="a"
            href="{{!$currentCategory ? 'javascript:;' : route('admin.dictionaries.categories.products.create', $currentCategory)}}"
            class="mr-1 p-3 ml-auto"
            type="button"
            variant="{{!$currentCategory ? 'secondary' : 'primary'}}"
            disabled
        >
            Добавить товар
        </x-base.button>
    </div>

    <div class="grid grid-cols-12 border border-t-2 mt-5">
        <div class="border border-r-2 col-span-12 xl:col-span-4 p-5">
            @foreach($categories as $category)
                <div class="flex justify-between py-1 border-b-2 my-2">
                    <a
                        wire:navigate
                        href="{{ route('admin.dictionaries.categories.index', ['category' => $category->id]) }}"
                        @class([
                            'text-sky-500 font-bold' => $currentCategory->id === $category->id,
                            'text-base'
                        ])
                    >
                        <x-base.icon :icon="$currentCategory->id === $category->id ? 'fa-folder-open' : 'fa-folder'"/>
                        {{$category->name}}
                    </a>

                    <div class="flex gap-2">
                        <x-base.button
                            as="a"
                            size="sm"
                            href="{{ route('admin.dictionaries.categories.edit', compact('category')) }}"
                            type="button"
                            variant="outline-success"
                        >
                            <x-base.icon icon="fa-pen"/>
                        </x-base.button>
                        <x-base.button
                            size="sm"
                            type="button"
                            variant="outline-danger"
                            wire:click="deleteCategory({{$category->id}})"
                            wire:confirm="Вы действительно хотите удалить катогорию?"
                        >
                            <x-base.icon icon="fa-trash"/>
                        </x-base.button>
                    </div>
                </div>
            @endforeach

            <a href="{{ route('admin.dictionaries.categories.create') }}" class="w-fit mt-8 transition duration-200 border
                    inline-flex items-center
                    justify-center py-2
                    px-3 rounded-md
                    font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary shadow-md">
                Добавить категорию
            </a>
        </div>
        <div class="col-span-12 xl:col-span-8">
            @if($currentCategory->products->count())
                <x-base.table id="receipts" class="mt-5">
                    <x-base.table.thead variant="light">
                        <x-base.table.tr>
                            <x-base.table.th class="whitespace-nowrap">#</x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap">
                                Наименование
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap">
                                Перечень
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap">
                                Ед. измерения
                            </x-base.table.th>
                            <x-base.table.th class="whitespace-nowrap">
                            </x-base.table.th>
                        </x-base.table.tr>
                    </x-base.table.thead>
                    <x-base.table.tbody>
                        @foreach($currentCategory->products as $product)
                            <x-base.table.tr>
                                <x-base.table.td>{{ $product->id }}</x-base.table.td>
                                <x-base.table.td>{{ $product->name }}</x-base.table.td>
                                <x-base.table.td>{{ $product->status }}</x-base.table.td>
                                <x-base.table.td>{{ $product->measure->name }}</x-base.table.td>
                                <x-base.table.td>
                                    <x-base.button
                                        as="a"
                                        size="sm"
                                        href="{{ route('admin.dictionaries.categories.products.edit', compact('category', 'product')) }}"
                                        type="button"
                                        variant="outline-success"
                                    >
                                        <x-base.icon icon="fa-pen"/>
                                    </x-base.button>
                                    <x-base.button
                                        size="sm"
                                        type="button"
                                        variant="outline-danger"
                                        wire:click="deleteProduct({{ $product->id }})"
                                        wire:confirm="Вы действительно хотите удалить товар?"
                                    >
                                        <x-base.icon icon="fa-trash"/>
                                    </x-base.button>
                                </x-base.table.td>
                            </x-base.table.tr>
                        @endforeach
                    </x-base.table.tbody>
                </x-base.table>
            @else
                <div role="alert"
                     class="alert mx-auto my-auto mt-4 relative border rounded-md px-5 py-4 bg-warning border-warning
                     bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center">
                    <x-base.icon icon="fa-circle-exclamation" class="text-lg mr-3"></x-base.icon>
                    Нет данных
                </div>
            @endif
        </div>
    </div>
</div>
