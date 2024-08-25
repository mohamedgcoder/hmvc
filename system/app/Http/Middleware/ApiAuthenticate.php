<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $authorization = request()->header('authorization');
        $token = Str::replace('Bearer ', '', $authorization);

        if (route('secret-key') == url()->current()) {
            if($token == _settings('settings', 'system_key'))
                return $next($request);
        }else{
            if($token == hash('sha512', _settings('settings', 'secret_key') . '&' . _settings('settings', 'domain') . '&' . _settings('settings', 'system_key')))
                return $next($request);
        }

        $message = [Str::of(__('errors.401.message'))->title()];

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
}
