<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProviderAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ProvidererData = session()->get('ProvidererData');

        if(empty($ProvidererData)){
            // return "Monty";
            return redirect()->route('provider_login_form');
        }// END if(empty($ProvidererData))
        return $next($request);
    }
}
