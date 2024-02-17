<!-- BEGIN: Top Bar -->
<div class="relative z-[51] flex h-[67px] items-center border-b border-slate-200">
    <!-- BEGIN: Breadcrumb -->
    <x-base.breadcrumb class="-intro-x mr-auto hidden sm:flex">
        <x-base.breadcrumb.link :index="0">
            <x-base.lucide icon="home"/>
        </x-base.breadcrumb.link>
        <x-base.breadcrumb.link
            :index="1"
            :active="true"
        >
            Dashboard
        </x-base.breadcrumb.link>
    </x-base.breadcrumb>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Account Menu -->
    <x-base.menu>
        <x-base.menu.button class="image-fit zoom-in intro-x block h-8 w-8 overflow-hidden rounded-full shadow-lg">
            <img
                src="{{ Vite::asset('resources/images/fakers/profile-1.jpg') }}"
                alt="Midone"
            />
        </x-base.menu.button>
        <x-base.menu.items class="mt-px w-56 bg-theme-1 text-white">
            <x-base.menu.header class="font-normal">
                <div class="font-medium">{{ Auth::user()->name }}</div>
                <div class="mt-0.5 text-xs text-white/70 dark:text-slate-500">{{ Auth::user()->email }}</div>
            </x-base.menu.header>
            <x-base.menu.divider class="bg-white/[0.08]"/>
            <x-base.menu.item class="hover:bg-white/5" :href="route('profile.edit')">
                <x-base.lucide
                    class="mr-2 h-4 w-4"
                    icon="User"
                />
                Profile
            </x-base.menu.item>
            <x-base.menu.item class="hover:bg-white/5" onclick="event.preventDefault();document.getElementById
                ('logout-form').submit();">
                <x-base.lucide
                    class="mr-2 h-4 w-4"
                    icon="ToggleRight"
                />
                Logout
            </x-base.menu.item>

            <form id="logout-form" method="POST" action="{{ route('logout') }}">
                @csrf
            </form>
        </x-base.menu.items>
    </x-base.menu>
    <!-- END: Account Menu -->
</div>
<!-- END: Top Bar -->

@pushOnce('scripts')
    @vite('resources/js/components/themes/rubick/top-bar.js')
@endPushOnce
