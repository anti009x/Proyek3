<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekLevel
{
    public function handle(Request $request, Closure $next, $role_id) {
        if ($request->user() && $request->user()->role_id == $role_id) {
            return $next($request);
        }
        return redirect('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    } 
}