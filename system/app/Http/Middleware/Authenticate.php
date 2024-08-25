<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next=null, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return $next($request);
        } else {
            if($guard == 'sanctum'){
                $message = [Str::of(__('errors.token.message'))->title()];

                // throw new HttpException(401);
                return response()->json([
                    'code' => 401,
                    'response-status' => false,
                    'messages' => $message, // show this message to user
                    'response' => [
                        'data-length' => 0,
                        'data' => null,
                    ],
                    // array
                    'error' => [
                        // string
                        'error-code' => '', // code for detect or refer to development team
                        // string
                        'error-message' => Str::title(__('errors.401.title')), // eror message to spesific error
                    ],
                ], 401);
            }

            return redirect(route('admin.login'));
        }
    }
}
