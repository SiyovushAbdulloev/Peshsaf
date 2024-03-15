<div>
    <div class="intro-y col-span-12 mt-2 mb-2 flex flex-wrap items-center ml-auto w-fit">
        <x-base.button
            as="a"
            href="{{!$currentCategory ? 'javascript:;' : route('admin.dictionaries.categories.products.create', $currentCategory)}}"
            class="mr-1 p-3 w-fit"
            type="button"
            variant="{{!$currentCategory ? 'secondary' : 'primary'}}"
            disabled
        >
            Добавить товар
        </x-base.button>
    </div>

    <div class="flex" style="border-top: 2px solid #e5e7eb">
        <div class="flex flex-col"
             style="border-right: 2px solid #e5e7eb; width: 35%; align-items: center; padding: 6px">
            @foreach($categories as $category)
                <div class="flex" style="width: 60%; justify-content: space-between">
                    <button
                        style="{{$currentCategory == $category->id ? 'color: skyblue;' : ''}}"
                        wire:click.prevent="fetchProducts({{$category->id}})"
                        type="button"
                    >
                        {{$category->name}}
                    </button>

                    <div class="flex" wire:ignore>
                        <a href="{{ route('admin.dictionaries.categories.edit', compact('category')) }}"
                           class="mr-4">
                            <x-base.lucide icon="pencil"/>
                        </a>
                        <a href="#" class="text-danger">
                            <x-base.lucide icon="trash"/>
                        </a>
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
        @if($products && $products->count())
            <table
                data-tw-merge
                class="text-left"
                style="flex: 1"
            >
                <thead data-tw-merge class="">
                <tr
                    data-tw-merge
                    class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                >
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        #
                    </th>
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        Наименование
                    </th>
                    <th
                        data-tw-merge
                        class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap"
                    >
                        &nbsp;
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr
                        data-tw-merge
                        class="[&amp;:nth-of-type(odd)_td]:bg-slate-100 [&amp;:nth-of-type(odd)_td]:dark:bg-darkmode-300 [&amp;:nth-of-type(odd)_td]:dark:bg-opacity-50"
                    >
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $product->id }}
                        </td>
                        <td
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300"
                        >
                            {{ $product->name }}
                        </td>
                        <td
                            wire:ignore
                            data-tw-merge
                            class="px-5 py-3 border-b dark:border-darkmode-300 flex flex-row"
                        >
                            <a href="{{ route('admin.dictionaries.categories.products.edit', compact('category', 'product')) }}"
                               class="mr-4">
                                <x-base.lucide icon="pencil"/>
                            </a>
                            <a href="#" class="text-danger">
                                <x-base.lucide icon="trash"/>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div wire:ignore role="alert"
                 class="alert mx-auto mt-4 relative border rounded-md px-5 py-4 bg-warning border-warning bg-opacity-20 border-opacity-5 text-warning dark:border-warning dark:border-opacity-20 mb-2 flex items-center">
                <i data-tw-merge data-lucide="alert-circle" class="stroke-1.5 w-5 h-5 mr-2 h-6 w-6 mr-2 h-6 w-6"></i>
                Нет данных
            </div>
        @endif
    </div>
</div>
