<div class="grid grid-cols-subgrid col-span-12">
    <div class="col-span-12 2xl:col-span-6">
        <x-base.form-label>Роль</x-base.form-label>
        <x-base.form-select
            aria-label="form-select-sm example"
            name="role"
            wire:model.live="role"
        >
            <option value="">Выберите роль</option>
            @foreach($roles as $r)
                <option
                    value="{{$r->name}}"
                    @selected(old($role, $user->role?->name) == $r->name)
                >
                    {{$r->description}}
                </option>
            @endforeach
        </x-base.form-select>
        @error('role')
            <div class="mt-2 text-danger">
                {{ $message }}
            </div>
        @enderror
    </div>

    @if($role === \App\Models\Role::VENDOR)
        <div class="col-span-12 2xl:col-span-6">
            <x-base.form-label>Торговая точка</x-base.form-label>
            <x-base.form-select
                aria-label="form-select-sm example"
                name="outlet"
                wire:model="outlet"
            >
                <option value="">Выберите торговую точку</option>
                @foreach($outlets as $o)
                    <option
                        value="{{$o->id}}"
                        @selected(old($outlet, $user->outlet_id) == $o->id)
                    >
                        {{$o->name}}
                    </option>
                @endforeach
            </x-base.form-select>
            @error('outlet')
            <div class="mt-2 text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    @endif

    @if($role === App\Models\Role::WAREHOUSE)
        <div class="col-span-12 2xl:col-span-6">
            <x-base.form-label>Склад</x-base.form-label>
            <x-base.form-select
                aria-label="form-select-sm example"
                name="warehouse"
                wire:model="warehouse"
            >
                <option value="">Выберите склад</option>
                @foreach($warehouses as $w)
                    <option
                        value="{{$w->id}}"
                        @selected(old($warehouse, $user->warehouse_id) == $w->id)
                    >
                        {{$w->name}}
                    </option>
                @endforeach
            </x-base.form-select>
            @error('warehouse')
            <div class="mt-2 text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    @endif
</div>
