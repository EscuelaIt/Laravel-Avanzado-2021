<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locales = config('app.locales');

        if ($request->has('locale')) {
            $locale = $request->locale;

            if (in_array($locale, $locales)) {
                App::setLocale($locale);
                Carbon::setLocale(app()->getLocale());
            }
        }
        return $next($request);
    }
}
