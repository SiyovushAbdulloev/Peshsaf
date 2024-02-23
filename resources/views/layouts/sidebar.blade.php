@extends('layouts/base')

@section('head')
    @yield('subhead')
@endsection

@section('sidebar')
    <nav class="side-nav hidden w-[80px] overflow-x-hidden pb-16 pr-5 md:block xl:w-[230px]">
        <a
            class="intro-x flex items-center pl-5 pt-4"
            href=""
        >
            <img
                class="w-6"
                src="{{ Vite::asset('resources/images/logo.svg') }}"
                alt="Midone - Tailwind Admin Dashboard Template"
            />
            <span class="ml-3 hidden text-lg text-white xl:block"> Rubick </span>
        </a>
        <div class="side-nav__divider my-6"></div>
        <ul>
            @foreach ($mainMenu as $menuKey => $menu)
                @if ($menu == 'divider')
                    <li class="side-nav__divider my-6"></li>
                @else
                    <li>
                        <a
                            href="{{ isset($menu['route_name']) ? route($menu['route_name'], isset($menu['params']) ? $menu['params'] : []) : 'javascript:;' }}"
                            @class([
                                $firstLevelActiveIndex == $menuKey
                                    ? 'side-menu side-menu--active'
                                    : 'side-menu',
                            ])
                        >
                            <div class="side-menu__icon">
                                <x-base.lucide icon="{{ $menu['icon'] }}" />
                            </div>
                            <div class="side-menu__title">
                                {{ $menu['title'] }}
                                @if (isset($menu['sub_menu']))
                                    <div
                                        class="side-menu__sub-icon {{ $firstLevelActiveIndex == $menuKey ? 'transform rotate-180' : '' }}">
                                        <x-base.lucide icon="ChevronDown" />
                                    </div>
                                @endif
                            </div>
                        </a>
                        @if (isset($menu['sub_menu']))
                            <ul class="{{ $firstLevelActiveIndex == $menuKey ? 'side-menu__sub-open' : '' }}">
                                @foreach ($menu['sub_menu'] as $subMenuKey => $subMenu)
                                    <li>
                                        <a
                                            href="{{ isset($subMenu['route_name']) ? route($subMenu['route_name'], isset($subMenu['params']) ? $subMenu['params'] : []) : 'javascript:;' }}"
                                            @class([
                                                $secondLevelActiveIndex == $subMenuKey
                                                    ? 'side-menu side-menu--active'
                                                    : 'side-menu',
                                            ])
                                        >
                                            <div class="side-menu__icon">
                                                <x-base.lucide icon="{{ $subMenu['icon'] }}" />
                                            </div>
                                            <div class="side-menu__title">
                                                {{ $subMenu['title'] }}
                                                @if (isset($subMenu['sub_menu']))
                                                    <div
                                                        class="side-menu__sub-icon {{ $secondLevelActiveIndex == $subMenuKey ? 'transform rotate-180' : '' }}">
                                                        <x-base.lucide icon="ChevronDown" />
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                        @if (isset($subMenu['sub_menu']))
                                            <ul
                                                class="{{ $secondLevelActiveIndex == $subMenuKey ? 'side-menu__sub-open' : '' }}">
                                                @foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu)
                                                    <li>
                                                        <a
                                                            href="{{ isset($lastSubMenu['route_name']) ? route($lastSubMenu['route_name'], isset($lastSubMenu['params']) ? $lastSubMenu['params'] : []) : 'javascript:;' }}"
                                                            @class([
                                                                $thirdLevelActiveIndex == $lastSubMenuKey
                                                                    ? 'side-menu side-menu--active'
                                                                    : 'side-menu',
                                                            ])
                                                        >
                                                            <div class="side-menu__icon">
                                                                <x-base.lucide icon="{{ $lastSubMenu['icon'] }}" />
                                                            </div>
                                                            <div class="side-menu__title">
                                                                {{ $lastSubMenu['title'] }}
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @endforeach
        </ul>
    </nav>
@endsection

@pushOnce('styles')
    @vite('resources/css/vendors/tippy.css')
    @vite('resources/css/themes/rubick/side-nav.css')
@endPushOnce

@pushOnce('vendors')
    @vite('resources/js/vendors/tippy.js')
@endPushOnce

@pushOnce('scripts')
    @vite('resources/js/themes/rubick.js')
@endPushOnce
