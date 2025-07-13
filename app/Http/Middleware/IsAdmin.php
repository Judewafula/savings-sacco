<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//class IsAdmin
//{
  //  public function handle(Request $request, Closure $next)
  //  {
        // Ensure the user is logged in and has the 'admin' role
      //  if (Auth::check() && Auth::user()->role === 'admin') {
       //     return $next($request);
       // }

        // Redirect non-admin users
      //  return redirect()->route('home')->with('error', 'You must be an admin to access this page!');
  //  }
//}

