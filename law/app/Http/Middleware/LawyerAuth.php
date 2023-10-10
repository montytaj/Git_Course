<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LawyerAuth
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
        $LawyerData = session()->get('LawyerData');

        if(empty($LawyerData)){

            return redirect()->route('lawyer_login_form');
        }// END if(empty($LawyerData))
        return $next($request);
    }
}
