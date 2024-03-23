<div>
    <div class="flex flex-row gap-3">
        <input type="hidden" name="client_id" value="{{$client['id'] ?? 0}}"/>
        <x-base.form-input
            class="w-full"
            id="number"
            type="text"
            value="{{$client['name'] ?? ''}}"
        />
        <x-base.form-input
            class="w-full"
            id="number"
            type="text"
            value="{{$client['address'] ?? ''}}"
        />
        <x-base.form-input
            class="w-full"
            id="number"
            type="text"
            value="{{$client['phone'] ?? ''}}"
        />
    </div>
</div>
