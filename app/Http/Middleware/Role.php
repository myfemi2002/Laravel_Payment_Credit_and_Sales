<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
//     public function handle(Request $request, Closure $next, $role)
//     {
//         if ($request->user()->role !== $role) {
//         return redirect('dashboard');
//         }
//         return $next($request);
//     }
// }

public function handle(Request $request, Closure $next, $role)
{
    if(auth()->user()->role == $role){
        return $next($request);
    }
    return new Response(view('errors.404'));
    // return views('errors.404');

    // return response()->json(['You do not have permission to access for this page.']);
    /* return response()->view('errors.check-permission'); */
}
}
