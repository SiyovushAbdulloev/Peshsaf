@if (session()->has('success'))
    <x-base.alert
        class="mb-2 flex items-center"
        variant="outline-success"
    >
        <x-base.lucide
            class="mr-2 h-6 w-6"
            icon="AlertTriangle"
        />
        {{ session('success') }}
        <x-base.alert.dismiss-button
            class="btn-close"
            type="button"
            aria-label="Close"
        >
            <x-base.lucide
                class="h-4 w-4"
                icon="X"
            />
        </x-base.alert.dismiss-button>
    </x-base.alert>
@endif

@if (session()->has('error'))
    <x-base.alert
        class="mb-2 flex items-center"
        variant="outline-danger"
    >
        <x-base.lucide
            class="mr-2 h-6 w-6"
            icon="AlertOctagon"
        />
        {{ session('error') }}
        <x-base.alert.dismiss-button
            class="btn-close"
            type="button"
            aria-label="Close"
        >
            <x-base.lucide
                class="h-4 w-4"
                icon="X"
            />
        </x-base.alert.dismiss-button>
    </x-base.alert>
@endif