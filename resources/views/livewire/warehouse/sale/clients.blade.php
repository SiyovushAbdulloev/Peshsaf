<div>
    <div class="flex flex-row gap-3">
        <x-base.form-input
            class="w-full"
            id="number"
            type="text"
            name="number"
            placeholder="Введите для поиска"
            wire:model="query"
            wire:keyup="search"
        />

        <x-base.button
            as="a"
            href="{{ route('warehouse.sales.create') }}"
            class="w-64 ml-auto"
            type="button"
            variant="primary"
            type="button"
        >
            +
            Новый покупатель
        </x-base.button>
    </div>

    <div class="mt-10">
        @forelse($clients ?? [] as $client)
            <div class="flex flex-row my-2" wire:key="{{ $client->id }}">
                <p>{{ $client->name }}</p>
                <x-base.button
                    as="a"
                    href="{{ route('warehouse.sales.create', compact('client')) }}"
                    class="w-24 ml-auto"
                    type="button"
                    variant="primary"
                    type="button"
                >
                    Продолжить
                </x-base.button>
            </div>
        @empty
            <div>Нет данных</div>
        @endforelse
    </div>
</div>
