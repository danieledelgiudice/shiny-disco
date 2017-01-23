<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ConfermaPromemoria
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::user()->isAdmin() || Auth::user()->ultima_conferma >= \Carbon\Carbon::today())
            return $next($request);
        else {
            return redirect()->action('PromemoriaController@indexToday', ['filiale' => Auth::user()->filiale])
                ->with('warning', 'Devi confermare di aver letto l\'agenda di oggi prima di poter fare altro');
        }
    }
}
