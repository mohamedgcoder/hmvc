<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Module\Settings\Http\Controllers\Web\Panel\SettingsController;

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

                Route::controller(SettingsController::class)->group(function () use($moduleName){
                    Route::get('/', 'index')->name('general');
                    Route::get('identity', 'identitySettings')->name('identity');
                    Route::get('appearance', 'appearanceSettings')->name('appearance');
                    Route::get('system', 'systemSettings')->name('system');
                    Route::get('seo', 'seoSettings')->name('seo');
                    Route::get('social', 'socialSettings')->name('social');
                    Route::get('security', 'securitySettings')->name('security');
                    Route::get('integrations', 'integrationsSettings')->name('integrations');

                    Route::put('generate-system-key', 'generateSystemKey')->name('system.key');
                    Route::put('generate-secret-key', 'generateSecretKey')->name('secret.key');

                    Route::put('update-settings', 'update')->name('update');

                    Route::put('clear-cashe', 'clearCashe')->name('clear.cashe');
                });
            });

        });
    });
}
