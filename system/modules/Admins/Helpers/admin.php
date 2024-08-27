<?php

/*
|--------------------------------------------------------------------------
| check if admin can update his profile or must request update from supper admin
|--------------------------------------------------------------------------
|
|
| @return boolean
|
 */
if (!function_exists('_can_update_profile')) {
    function _can_update_profile(): bool
    {
        return (!_settings('admin', 'request_update_profile'))? true : ((auth()->user()->can_update_profile)? true : false);
    }
}