<div class="grid grid-cols-2 gap-3">
    
    <x-base.form-input
        class="w-full"
        id="number"
        type="text"
        name="number"
        value="{{ old('number', $return->number) }}"
    />
    <x-base.litepicker
        class="pl-12 w-full"
        data-single-mode="true"
        value="{{old('date', $return->date)}}"
        name="date"
    />
</div>
