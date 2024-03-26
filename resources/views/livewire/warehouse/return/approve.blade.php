<x-base.button
    type="button"
    variant="primary"
    wire:confirm="Вы действительно хотите одобрить возврат?"
    wire:click="approve"
    wire:loading.attr="disabled"
>
    Одобрить
</x-base.button>
