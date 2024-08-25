<?php

use Illuminate\Support\Facades\Route;
use Languages\Http\Controllers\Api\LanguagesController;

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
    Route::prefix(_prefix("panel-api", _modulePrefix($moduleName)))->group(function() use($moduleName){

        // route has middleware for guest
        Route::middleware(_moduleMiddleware($moduleName, "guest"))->group(function() use($moduleName){

            // Route here
            Route::controller(LanguagesController::class)->group(function () {
                Route::get("/", "systemLanguages");
            });

            // route has custom middleware with guest middleware
            Route::middleware([])->group(function() use($moduleName){

                // Route here

            });

        });

        // route has middleware for auth
        Route::middleware(_moduleMiddleware($moduleName, "auth"))->group(function() use($moduleName){

            // Route here

            // route has custom middleware with auth middleware
            Route::middleware([])->group(function() use($moduleName){

                // Route here

            });

        });

        // route has custom middleware
        Route::middleware([])->group(function() use($moduleName){

            //

        });
    });
}
