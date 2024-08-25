<?php

use Illuminate\Support\Facades\Route;

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
    Route::namespace(_moduleNamespace($moduleName))->prefix(_prefix('/api'))->group(function() use($moduleName){
        Route::middleware(['guest'])->group(function() use($moduleName){
            Route::prefix(_modulePrefix($moduleName))->group(function() use($moduleName){

                // 
                Route::group(['middleware' => ['user:api']], function () {
                    // 
                });

            });
        });
    });
}