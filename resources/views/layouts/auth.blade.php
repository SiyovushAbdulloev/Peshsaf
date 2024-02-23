<!DOCTYPE html>
<html
    class="opacity-0"
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
>
<head>
    <meta charset="utf-8">
    <title>Пешсаф - Авторизация</title>
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <!-- BEGIN: CSS Assets-->
    @stack('styles')
    <!-- END: CSS Assets-->

    @vite('resources/css/app.css')
</head>
<!-- END: Head -->

<body>
@yield('content')

@vite('resources/js/vendors/dom.js')
@vite('resources/js/components/base/theme-color.js')

@yield('scripts')
</body>
</html>
