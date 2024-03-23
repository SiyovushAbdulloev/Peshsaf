<div class="grid grid-cols-2 gap-3">
    <x-base.form-check class="mr-2">
        <x-base.form-check.input
            name="warehouse"
            type="radio"
            value="0"
            id="no-limit"
            :checked="old('is_limited', $user->is_limited) == 0"
        />
        <x-base.form-check.label for="no-limit">
            Нет ограничения
        </x-base.form-check.label>
    </x-base.form-check>
</div>
