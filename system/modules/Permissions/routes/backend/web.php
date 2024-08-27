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
    Route::namespace(_moduleNamespace($moduleName))->prefix(_prefix('panel'))->group(function() use($moduleName){
        Route::prefix(_modulePrefix($moduleName))->group(function() use($moduleName){

            //
            Route::middleware(_moduleMiddleware($moduleName))->group(function() {

                Route::get('/', [PermissionsController::class, 'index'])->name('permissions.index');
                //
            });
        });
    });
}
