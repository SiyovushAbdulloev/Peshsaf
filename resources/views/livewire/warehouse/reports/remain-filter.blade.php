<div class="flex gap-8 mt-8 items-center">
    <x-base.form-select
        class="w-1/4"
        aria-label="form-select-sm example"
        wire:model="option"
        wire:change="setDates"
    >
        <option value="">Выберите дату</option>
        @foreach($options as $option)
            <option value="{{$option['value']}}" wire:key="{{$option['value']}}">
                {{$option['label']}}
            </option>
        @endforeach
    </x-base.form-select>
    <x-base.litepicker
        class="w-1/6"
        data-single-mode="true"
        id="from"
        wire:model="to"
    />
    <span>до</span>
    <x-base.litepicker
        class="w-1/6"
        data-single-mode="true"
        id="to"
        wire:model="to"
    />
    <x-base.button
        class="w-24"
        variant="primary"
        type="button"
        wire:click="search"
    >
        Поиск
    </x-base.button>
</div>
