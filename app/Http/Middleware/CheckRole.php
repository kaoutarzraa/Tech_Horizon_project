<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @param  string  $role
    * @return mixed
    */

   public function handle(Request $request, Closure $next, $role)
   {
       // Check if the user is logged in and has the specified role
       if (Auth::check() && Auth::user()->role === $role) {
           return $next($request);
       }

       // If the user doesn't have the role, redirect them
       return redirect()->route('home')->withErrors(['role' => 'You do not have the required permissions.']);
   }
}
