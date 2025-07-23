<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class IsAdminMiddleware
{
    const ADMIN_TYPE_ID = 1;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $type_id = Auth::user()?->employees?->toArray()[0]['type_id'];
        if (Auth::check() && $type_id === self::ADMIN_TYPE_ID) {
            return $next($request);
        }
        Auth::logout();
        abort(403, 'Acesso não autorizado.');
    }
}
