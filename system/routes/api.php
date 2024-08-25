<?php

use Admins\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

if(env('APP_DEBUG') && env('APP_ENV')){
    Route::middleware(['tenant'])->post('/generate-code', function (Request $request) {
        // Auth::attempt(['email' => 'owner@app1.ordrz.test', 'password' => '123456']);
        // $user = Admin::where('Email' , 'owner@app1.ordrz.test')->first();
        // $token = $user->createToken($user->code)->accessToken;
        return response()->json([
            'code' => 200,
            'response-status' => true,
            'messages' => '', // show this message to user
            'response' => [
                'data-length' => 1,
                'token' => hash('sha512', _settings('settings', 'secret_key') . '&' . _settings('settings', 'domain') . '&' . _settings('settings', 'system_key')),
                // 'admin-token' => $token
            ],
            // array
            'error' => [
                // string
                'error-code' => '', // code for detect or refer to development team
                // string
                'error-message' => '', // eror message to spesific error
            ],
        ]);
    });
}
