@if (session()->has('success'))
    <div role="alert" class="alert relative border rounded-md px-5 py-4 bg-success border-success text-slate-900
dark:border-success mt-2 flex items-center">
        <x-base.icon icon="fa-triangle-exclamation" class="text-lg mr-3"></x-base.icon>
        {{ session('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div role="alert" class="alert relative border rounded-md px-5 py-4 bg-danger border-danger text-slate-900
dark:border-danger mt-2 flex items-center">
        <x-base.icon icon="fa-triangle-exclamation" class="text-lg mr-3"></x-base.icon>
        {{ session('error') }}
    </div>
@endif
