<?php

use Illuminate\Support\Facades\Route;

$moduleName = basename(dirname(__DIR__, 2));

/*
|--------------------------------------------------------------------------
| Language Routes
|--------------------------------------------------------------------------
|
| Here is Routes for global Language module
| set locale lang
| and return data table lang
|
*/

Route::get('datatable/lang', function() {
    $language = _datatable_translation();

    return response($language);
})->name('datatable.language');

Route::get('/language/{locale}', function($locale) {
    App::setLocale($locale);
    Session::put('locale', $locale);
    return redirect()->back();
});

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
    Route::prefix(_prefix("front", _modulePrefix($moduleName)))->group(function() use($moduleName){

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
