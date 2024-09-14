<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/create', function () {
    $file = _RD(). 'assets/global/data/languages/all.json';
    $languages = json_decode(file_get_contents($file), true);
    foreach($languages as $language){
        // rename(_RD().'assets/global/data/locales/'.$language['code'].'/country.json', _RD().'assets/global/data/languages/'.$language['code'].'/language.json');
        // if(!File::exists(_RD().'assets/global/data/languages/'.$language['code'])) {
            // mkdir(_RD().'assets/global/data/locales/'.$language['code'], 0777, true);
        // }
    }
});
