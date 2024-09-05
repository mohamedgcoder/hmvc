<?php

/*
|--------------------------------------------------------------------------
| settings
|--------------------------------------------------------------------------
|
| //
|
 */

use Module\Menus\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Module\Menus\Http\Resources\MenuResource;
use Module\Languages\Service\LanguagesService;

if (!function_exists('_getMenu')) {
    function _getMenu(string $type = null) : array
    {
        // cached and return menu
        $cacheName = _get_cache_name('menu');
        // _forget_cache($cacheName);
        return cache()->remember($cacheName, _cache_remember_time(), function() use($type) {
            $menu = [];
            $groups = Menu::where(function($query) use ($type){
                if($type != null)
                    return $query->where('type', (_is_admin())? 'admin' : $type);
            })
            ->where('module', 'group')
            ->orderBy('arrangement')
            ->with('menuTrans')
            ->get();

            foreach($groups as $group){
                $menu[LanguagesService::getName($group->menuTrans)] = _getparent($group->id);
            }

            return $menu;
        });
    }
}

if (!function_exists('_getparent')) {
    function _getparent(int $groupId) : array
    {
        try {
            $items = Menu::where('group', $groupId)
                ->where('parent', 0)
                ->whereNotNull('module')
                ->orderBy('arrangement')
                ->with('menuTrans')
                ->get();

            return MenuResource::collection($items)->resolve();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

