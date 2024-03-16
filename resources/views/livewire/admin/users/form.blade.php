<div
    class="grid grid-cols-2 col-span-1"
>
    <div
        @class([
           "w-full",
           $role => "col-span-1",
           !$role => "col-span-2"
       ])
    >
        <x-base.form-label>Роль</x-base.form-label>
        <x-base.form-select
            class="mt-2"
            formSelectSize="md"
            aria-label="form-select-sm example"
            name="role"
            wire:model="role"
            wire:change="setRole"
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
        <h5 class="mt-3 text-lg font-medium leading-none text-danger">
            @error('role')
            {{ $message }}
            @enderror
        </h5>
    </div>

    @if($roleSelect === \App\Models\Role::VENDOR)
        <div class="w-full col-span-2">
            <x-base.form-label>Торговые точки</x-base.form-label>
            <x-base.form-select
                class="mt-2"
                formSelectSize="md"
                aria-label="form-select-sm example"
                name="outlet"
                wire:model="outlet"
            >
                <option value="">Выберите торговую точку</option>
                @foreach($outlets as $o)
                    <option
                        value="{{$o->id}}"
                        @selected(old($outlet, $user->outlet?->id) == $o->id)
                    >
                        {{$o->name}}
                    </option>
                @endforeach
            </x-base.form-select>
            <h5 class="mt-3 text-lg font-medium leading-none text-danger">
                @error('outlet')
                {{ $message }}
                @enderror
            </h5>
        </div>
    @endif

    @if($roleSelect === App\Models\Role::WAREHOUSE)
        <div class="w-full col-span-2">
            <x-base.form-label>Склады</x-base.form-label>
            <x-base.form-select
                class="mt-2"
                formSelectSize="md"
                aria-label="form-select-sm example"
                name="warehouse"
                wire:model="warehouse"
            >
                <option value="">Выберите склад</option>
                @foreach($warehouses as $w)
                    <option
                        value="{{$w->id}}"
                        @selected(old($warehouse, $user->warehouse?->id) == $w->id)
                    >
                        {{$w->name}}
                    </option>
                @endforeach
            </x-base.form-select>
            <h5 class="mt-3 text-lg font-medium leading-none text-danger">
                @error('warehouse')
                {{ $message }}
                @enderror
            </h5>
        </div>
    @endif
</div>
