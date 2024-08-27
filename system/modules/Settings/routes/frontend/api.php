<?php

use Illuminate\Support\Facades\Route;
use Settings\Http\Controllers\Api\SettingsController;

$moduleName = basename(dirname(__DIR__, 2));

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "API" middleware group. Now create something great!
|
*/

if(_moduleHasRoute($moduleName)){
    Route::prefix('/api')->group(function() use($moduleName){
        Route::middleware(_moduleMiddleware($moduleName))->group(function() use($moduleName){
            Route::prefix(_modulePrefix($moduleName))->group(function() use($moduleName){

                //
                Route::middleware(_moduleMiddleware($moduleName, 'guest'))->group(function() use($moduleName){
                    Route::controller(SettingsController::class)->group(function () {
                        Route::get('/secret-key', 'secretKey')->name('secret-key');
                    });
                });

                // auth routes
                Route::middleware(_moduleMiddleware($moduleName, 'auth'))->group(function() use($moduleName){
                    //
                });
            });
        });
    });
}
