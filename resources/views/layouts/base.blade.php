<!DOCTYPE html>
<html
    class="opacity-0"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
<head>
    <meta charset="utf-8">
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    @yield('head')

    <!-- BEGIN: CSS Assets-->
    @stack('styles')
    <!-- END: CSS Assets-->

    @vite('resources/css/vendors/tippy.css')
    @vite('resources/css/themes/rubick/side-nav.css')
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<!-- END: Head -->

<body>
<div @class([
            'rubick px-5 sm:px-8 py-5',
            "before:content-[''] before:bg-gradient-to-b before:from-theme-1 before:to-theme-2 dark:before:from-darkmode-800 dark:before:to-darkmode-800 before:fixed before:inset-0 before:z-[-1]",
        ])>
    <x-mobile-menu/>
    <div class="mt-[4.7rem] flex md:mt-0">
        <!-- BEGIN: Side Menu -->
        @yield('sidebar')
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div
            class="md:max-w-auto min-h-screen min-w-0 max-w-full flex-1 rounded-[30px] bg-slate-100 px-4 pb-10 before:block before:h-px before:w-full before:content-[''] dark:bg-darkmode-700 md:px-[22px]">
            <x-themes.rubick.top-bar/>
            @yield('content')
        </div>
        <!-- END: Content -->
    </div>
</div>

<!-- BEGIN: Vendor JS Assets-->
@vite('resources/js/vendors/dom.js')
@vite('resources/js/vendors/tailwind-merge.js')
@stack('vendors')
@vite('resources/js/vendors/tippy.js')
<!-- END: Vendor JS Assets-->

<!-- BEGIN: Pages, layouts, components JS Assets-->
@vite('resources/js/components/base/theme-color.js')
@vite('resources/js/themes/rubick.js')
<script type="module" src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

@vite('resources/js/app.js')
@stack('scripts')
@livewireScripts
</body>
</html>
