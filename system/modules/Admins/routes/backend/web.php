<?php

use Illuminate\Support\Facades\Route;

use Module\Admins\Http\Controllers\Web\Auth\LoginController;
use Module\Admins\Http\Controllers\Web\Auth\ResetPasswordController;

use Module\Admins\Http\Controllers\Web\Account\DashboardController;
use Module\Admins\Http\Controllers\Web\Account\ProfileController;

use Module\Admins\Http\Controllers\Web\Panel\AdminsController;

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
// Global Prefix
Route::group(['prefix' => _prefix('panel'), 'as' => 'admin.'], function () use($moduleName){

    // Route for Authentication
    Route::middleware(_moduleMiddleware($moduleName))->group(function (){

        // with middleware guest
        Route::get('/login', [LoginController::class, 'login'])->name('login');
        Route::post('/signin', [LoginController::class, 'signin'])->name('signin');
        Route::get('/password-recover', [ResetPasswordController::class, 'forgetPassword'])->name('forgetPassword');
        Route::post('/password-recover', [ResetPasswordController::class, 'recoverPassword'])->name('recoverPassword');
        Route::get('/password-reset', [ResetPasswordController::class, 'resetPassword'])->name('resetPassword');
        Route::put('/password-set', [ResetPasswordController::class, 'setNewPassword'])->name('setNewPassword');

        // ajax check email if exist
        Route::post('/check-if-email-exist', [ResetPasswordController::class, 'checkIfEmailExistAjax'])->name('check.email');
        // ajax check if old password
        Route::post('/check-if-old-password', [ResetPasswordController::class, 'checkIfOldPasswordAjax'])->name('check.password.old');
    });

    Route::middleware(_moduleMiddleware($moduleName, "guest"))->group(function (){

        Route::get('/unlock', [LoginController::class, 'lockAccount'])->name('unlock');
        Route::post('/unlock', [LoginController::class, 'unlock'])->name('unlock');
        Route::any('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/', [DashboardController::class, 'index'])->name('panel');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    });

});

if(_moduleHasRoute($moduleName)){
    Route::group(['prefix' => _prefix('panel', _modulePrefix($moduleName)), 'as' => _modulePrefix($moduleName).'.'], function() use($moduleName){
        //
        Route::middleware(_moduleMiddleware($moduleName, "auth"))->group(function () use($moduleName){

            Route::controller(AdminsController::class)->group(function () use($moduleName){
                Route::get('/', 'index')->name('index');
                Route::get('{id}/view', 'show')->name('show');
                Route::get('{id}/edit', 'edit')->name('edit');
                Route::put('update', 'update')->name('update');
                Route::get('add', 'create')->name('create');
                Route::post('store', 'store')->name('store');

                Route::delete(_moduleName($moduleName).'/delete', 'delete')->name('delete');
                Route::get('all', 'getAllAjax')->name('getall');
            });

        });
    });
}
