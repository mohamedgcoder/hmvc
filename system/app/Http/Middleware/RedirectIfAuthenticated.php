<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $ex = [
            _url('panel', 'login'),
            _url('panel', 'signin'),
            _url('panel', 'password-recover'),
            _url('panel', 'password-reset'),
            _url('panel', 'check-if-email-exist'),
            _url('panel', 'check-if-old-password'),
        ];
        session()->put('exeption_pages', $ex);

        if (Auth::check()) {
            if (in_array(Auth::user()->status, [1, 3, 4])){
                session()->put('announcement', ['type' => 'alert-warning ', 'message' => Auth::user()->status_message]);
                if(!in_array(url()->current(), [_url('panel', '/'), _url('panel', 'logout')]))
                    return redirect(route('admin.panel'));
            }

            $authEx = [
                _url('panel', 'login'),
                _url('panel', 'signin'),
                _url('panel', 'password-recover'),
                _url('panel', 'password-reset'),
            ];

            if (in_array(url()->current(), $authEx)) {
                return redirect(route('admin.panel'));
            }
        }else{
            $route = _is_admin() ? 'admin.login' : '/';

            if (in_array(url()->current(), [_url('panel', '/'), _url('panel', 'logout'), _url('panel', 'unlock')])) {
                return redirect()->route($route);
            }

            if(in_array(url()->current(), $ex)){
                return $next($request);
            }

            return redirect()->route($route, ['redirect' => $request->path()]);
        }

        return $next($request);
    }
}
