<?php

use Illuminate\Support\Facades\Route;
use Languages\Http\Controllers\Web\Panel\LanguagesController;

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
    Route::prefix(_prefix("panel", _modulePrefix($moduleName)))->group(function() use($moduleName){

        // route has middleware for guest
        Route::middleware(_moduleMiddleware($moduleName, "guest"))->group(function() use($moduleName){

            // Route group controller here
            Route::controller(LanguagesController::class)->group(function () {
                // Route here
            });

            // route has custom middleware with guest middleware
            Route::middleware([])->group(function() use($moduleName){

                // Route here

            });

        });

        // route has middleware for auth
        Route::middleware(_moduleMiddleware($moduleName, "auth"))->group(function() use($moduleName){

            // Route here
            Route::get('/translations', [LanguagesController::class, 'translations'])->name('language.translations');

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



if(_moduleHasRoute($moduleName)){
    Route::prefix(_prefix('panel'))->group(function() use($moduleName){

        Route::group(['prefix' => _modulePrefix($moduleName), 'as' => _modulePrefix($moduleName).'.'], function() use($moduleName){

            // route has middleware for guest
            Route::middleware(_moduleMiddleware($moduleName, "guest"))->group(function() use($moduleName){

                // Route group controller here
                Route::controller(LanguagesController::class)->group(function () {
                    // Route here
                });

                // route has custom middleware with guest middleware
                Route::middleware([])->group(function() use($moduleName){

                    // Route here

                });

            });

            // route has middleware for auth
            Route::middleware(_moduleMiddleware($moduleName, "auth"))->group(function() use($moduleName){

                // Route here
                Route::controller(LanguagesController::class)->group(function () use($moduleName){
                    Route::get('/', 'index')->name('index');
                    Route::get('/add', 'create')->name('add');
                    Route::get('/save', 'store')->name('save');

                    Route::get('/translations', 'translations')->name('translations');
                    Route::get('all', 'getAllAjax')->name('getall');
                });

                // route has custom middleware with auth middleware
                Route::middleware([])->group(function() use($moduleName){

                    // Route here

                });

            });

        });

        // route has custom middleware
        Route::middleware([])->group(function() use($moduleName){

            //

        });
    });
}
