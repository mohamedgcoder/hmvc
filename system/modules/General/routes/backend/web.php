<?php

use Illuminate\Support\Facades\Route;
use General\Http\Controllers\Web\Panel\StatusController;

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
        Route::prefix(_modulePrefix($moduleName))->group(function() use($moduleName){

            Route::controller(StatusController::class)->group(function (){
                Route::get('status', 'index')->name('status.index');
                Route::get('{id}/edit', 'edit')->name('status.edit');
                Route::put('update', 'update')->name('status.update');
                Route::put('translations/update/{language}', 'updateTranslationsString')->name('status.update.translations');
                Route::delete('delete', 'delete')->name('status.delete');
                Route::get('all-status', 'getAllAjax')->name('status.getall');
            });

            //
            Route::middleware(_moduleMiddleware($moduleName))->group(function() {
                //
            });
        });
    });
}


// if(_moduleHasRoute($moduleName)){
//     Route::namespace(_moduleNamespace($moduleName))->prefix(_prefix('panel'))->group(function() use($moduleName){
//         Route::prefix(_modulePrefix($moduleName))->group(function() use($moduleName){

//             //
//             Route::middleware(_moduleMiddleware($moduleName))->group(function() {

//                 Route::resources(['genders' => GendersController::class]);
//                 Route::get('all/genders', [GendersController::class, 'getAllAjax'])->name('genders.getall');
//                 Route::delete('gender/delete', [GendersController::class, 'delete'])->name('genders.delete');

//                 Route::resources(['titles' => TitlesController::class]);
//                 Route::get('all/titles', [TitlesController::class, 'getAllAjax'])->name('titles.getall');
//                 Route::delete('title/delete', [TitlesController::class, 'delete'])->name('titles.delete');
//             });
//         });
//     });
// }
