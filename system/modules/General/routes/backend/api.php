<?php

use Illuminate\Support\Facades\Route;
use General\Http\Controllers\Api\StatusController;
use General\Http\Controllers\Api\TitlesController;
use General\Http\Controllers\Api\GendersController;

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
    Route::prefix(_prefix("panel", _modulePrefix($moduleName)))->group(function() use($moduleName){

        // route has middleware for guest
        Route::middleware(_moduleMiddleware($moduleName, "guest"))->group(function() use($moduleName){

            // Status Route
            Route::prefix('status')->group(function() {

                Route::controller(StatusController::class)->group(function () {
                    Route::get('/{module?}', 'index');
                });

            });

            // Genders Route
            Route::prefix('genders')->group(function() {

                Route::controller(GendersController::class)->group(function () {
                    Route::get('/', 'index');
                });

            });

            // Titles Route
            Route::prefix('titles')->group(function() {

                Route::controller(TitlesController::class)->group(function () {
                    Route::get('/', 'index');
                });

            });

            // route has custom middleware with guest middleware
            Route::middleware([])->group(function() use($moduleName){

                // Route here

            });

        });

        // route has middleware for auth
        Route::middleware(_moduleMiddleware($moduleName, "auth"))->group(function() use($moduleName){

            // Status Route
            Route::prefix('status')->group(function() {

                Route::controller(StatusController::class)->group(function () {
                    //
                });

            });

            // Genders Route
            Route::prefix('genders')->group(function() {

                Route::controller(GendersController::class)->group(function () {
                    //
                });

            });

            // Titles Route
            Route::prefix('titles')->group(function() {

                Route::controller(TitlesController::class)->group(function () {
                    //
                });

            });

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
