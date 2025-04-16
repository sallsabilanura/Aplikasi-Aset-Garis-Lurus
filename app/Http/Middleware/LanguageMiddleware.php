<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('app_locale')) {
            App::setLocale(Session::get('app_locale'));
        }

        return $next($request);
    }
}

