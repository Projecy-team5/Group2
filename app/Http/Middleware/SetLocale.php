<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the locale from session, default to 'en' if not set
        $locale = session('app_locale', config('app.locale', 'en'));

        // Set the application locale
        app()->setLocale($locale);

        return $next($request);
    }
}
