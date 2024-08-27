<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

$moduleName = basename(dirname(__DIR__, 2));

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(_moduleMiddleware($moduleName, "guest"))->get('/', function () {
    return DB::table('lang_translations')->where('id', 1)->get();
});
