<?php

use Illuminate\Support\Facades\Route;
use Module\Permissions\Http\Controllers\Panel\PermissionsController;

$moduleName = basename(dirname(__DIR__, 2));

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if(_moduleHasRoute($moduleName)){
    Route::group(['prefix' => _prefix('panel', _modulePrefix($moduleName)), 'as' => _modulePrefix($moduleName).'.'], function() use($moduleName){
        //
        Route::middleware(_moduleMiddleware($moduleName, "auth"))->group(function () use($moduleName){

            Route::controller(PermissionsController::class)->group(function () use($moduleName){
                Route::get('/', 'index')->name('index');
                Route::get('roles', 'show')->name('roles');
            });

        });
    });
}
