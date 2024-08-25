<?php

namespace Languages\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = _current_Language();
        // $locale = (Session::get('locale') != null) ? Session::get('locale'): _default_lang();

        App::setLocale($locale);

        // set setting congigration
        $systemConfig = _get_settings();
        config(['app.settings' => $systemConfig]);

        return $next($request);
    }
}
