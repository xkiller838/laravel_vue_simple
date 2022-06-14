<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Status
{
   
    public function handle($request, Closure $next)
    {
        
        if (auth()->check() && auth()->user()->estado== 0) {

            auth()->logout();
            
            if (auth()->user()->estado == 1) {

                $message = 'Bienvenido';
                
            } else {

                $message = 'Su cuenta a sido suspendida';
            }

            return redirect()->route('login')->withMessage($message);

        }

        return $next($request);
    }
}
