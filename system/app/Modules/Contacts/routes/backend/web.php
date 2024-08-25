<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Contacts\Http\Controllers\Web\Panel\ContactsController;

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
    Route::prefix(_prefix('panel'))->group(function() use($moduleName){

        // save theme mode
        Route::post('/theme-mode', function(Request $request) {
            _theme_mode($request->mode);
        })->name('theme.mode');

        Route::group(['prefix' => _modulePrefix($moduleName), 'as' => _modulePrefix($moduleName).'.'], function() use($moduleName){

            //
            Route::middleware(_moduleMiddleware($moduleName))->group(function() use($moduleName){

                Route::controller(ContactsController::class)->group(function () use($moduleName){
                    Route::get('/', 'index')->name('index');
                    // Route::put('update-contacts', 'update')->name('update');
                });
            });

        });
    });
}