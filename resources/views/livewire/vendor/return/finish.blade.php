<x-base.button
    class="text-white"
    type="button"
    variant="success"
    wire:click="finish"
    wire:confirm="Вы действительно хотите завершить возврат?"
    wire:loading.attributes="disabled"
>
    Завершить
</x-base.button>
