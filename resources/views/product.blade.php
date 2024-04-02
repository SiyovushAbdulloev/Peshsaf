<x-base.slideover.description id="body">
    <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
        <div class="box rounded-md p-5">
            <div class="mb-5 flex items-center border-b border-slate-200/60 pb-5 dark:border-darkmode-400">
                <div class="truncate text-base font-medium">
                    Детали продукта
                </div>
            </div>
            <div class="flex items-center">
                Наименование: <span class="ml-2">{{ $product->name }}</span>
            </div>
            <div class="mt-3 flex items-center">
                Штрих код: <span class="ml-2">{{ $product->barcode }}</span>
            </div>
            <div class="mt-3 flex items-center">
                Категория: <span class="ml-2">{{ $product->category?->name }}</span>
            </div>
            <div class="mt-3 flex items-center">
                Действующее вещество: <span class="ml-2">{{ $product->activeIngredient?->name }}</span>
            </div>
            <div class="mt-3 flex items-center">
                Единица измерения: <span class="ml-2">{{ $product->measure?->name }}</span>
            </div>
            <div class="mt-3 flex items-center">
                Страна: <span class="ml-2">{{ $product->country?->name }}</span>
            </div>
            <div class="mt-3 flex items-center">
                Срок годности: <span class="ml-2">{{ $product->expire_date }}</span>
            </div>
            <div class="mt-3 items-center">
                Документы:
                <div class="gap-2">
                    @foreach($product->files as $file)
                        <div class="flex">
                            <x-base.icon icon="fa-paperclip" class="mr-2"/>
                            <a href="{{ $file->url }}" class="text-wrap">{{ $file->original_filename }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mt-3 flex items-center">
                Описание: <span class="ml-2">{{ $product->description }}</span>
            </div>
        </div>
    </div>
</x-base.slideover.description>
