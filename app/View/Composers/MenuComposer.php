<?php

namespace App\View\Composers;

use Illuminate\View\View;

class MenuComposer
{
    public function compose(View $view): void
    {
        if (auth()->check()) {
            $menu = config('project.menu')[auth()->user()->role?->name]; // TODO get user role
            if (!is_null(request()->route())) {
                $pageName = request()->route()->getName();
                $activeMenu = $this->activeMenu($pageName, $menu);

                $view->with('mainMenu', $menu);

                $view->with('firstLevelActiveIndex', $activeMenu['first_level_active_index']);
                $view->with('secondLevelActiveIndex', $activeMenu['second_level_active_index']);
                $view->with('thirdLevelActiveIndex', $activeMenu['third_level_active_index']);

                $view->with('pageName', $pageName);
            }
        }
    }

    /**
     * Set active menu & submenu.
     */
    protected function activeMenu($pageName, array $menuItems): array
    {
        $firstLevelActiveIndex = '';
        $secondLevelActiveIndex = '';
        $thirdLevelActiveIndex = '';

        foreach ($menuItems as $menuKey => $menu) {
            if ($menu !== 'divider' && isset($menu['route_name']) && $menu['route_name'] == $pageName && empty($firstPageName)) {
                $firstLevelActiveIndex = $menuKey;
            }

            if (isset($menu['sub_menu'])) {
                foreach ($menu['sub_menu'] as $subMenuKey => $subMenu) {
                    if (isset($subMenu['route_name']) && $subMenu['route_name'] == $pageName && $menuKey != 'menu-layout' && empty($secondPageName)) {
                        $firstLevelActiveIndex = $menuKey;
                        $secondLevelActiveIndex = $subMenuKey;
                    }

                    if (isset($subMenu['sub_menu'])) {
                        foreach ($subMenu['sub_menu'] as $lastSubMenuKey => $lastSubMenu) {
                            if (isset($lastSubMenu['route_name']) && $lastSubMenu['route_name'] == $pageName) {
                                $firstLevelActiveIndex = $menuKey;
                                $secondLevelActiveIndex = $subMenuKey;
                                $thirdLevelActiveIndex = $lastSubMenuKey;
                            }
                        }
                    }
                }
            }
        }

        return [
            'first_level_active_index' => $firstLevelActiveIndex,
            'second_level_active_index' => $secondLevelActiveIndex,
            'third_level_active_index' => $thirdLevelActiveIndex
        ];
    }
}
