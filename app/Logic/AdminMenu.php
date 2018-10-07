<?php

namespace App\Logic;

class AdminMenu
{
    public static function getMenuHtml()
    {
        $menuTree = config('admin.side_nav');
        return self::arrayToHtml($menuTree);
    }

    protected static function renderMenuItem($label, $link, $icon, $hasChild = false, $childrenHtml = '')
    {
        return '
         <li ' . (strpos($link, request()->getRequestUri()) !== false ? 'class="active"' : '') . '>
            <a class="' . ($hasChild ? 'menu-toggle' : '') . ' waves-effect waves-block" href="' . $link . '">
                ' . ($icon ? '<i class="material-icons">' . $icon . '</i>' : '') . '
                <span>' . $label . '</span>
            </a>
            ' . $childrenHtml . '
        </li>
        ';
    }

    protected static function arrayToHtml($menuTree)
    {
        $outputHtml = '';

        foreach ($menuTree as $menu) {
            $outputHtml .= self::renderMenuItem(
                $menu['label'],
                !empty($menu['route']) ? route($menu['route']) : 'javascript:void(0)',
                !empty($menu['icon']) ? $menu['icon'] : null,
                isset($menu['children']),
                isset($menu['children']) ? '<ul class="ml-menu">' . self::arrayToHtml($menu['children']) . '</ul>' : ''
            );
        }

        return $outputHtml;
    }
}