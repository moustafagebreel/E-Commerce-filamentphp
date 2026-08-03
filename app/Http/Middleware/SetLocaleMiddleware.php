<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->header('Accept-Language', session('locale', config('app.locale')));

        if (in_array($locale, ['en', 'ar'])) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
