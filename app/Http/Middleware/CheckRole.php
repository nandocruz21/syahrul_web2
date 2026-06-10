<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // cek user login & role
        if (!auth()->check() || auth()->user()->role !== $role) {
            return response()->json([
                'message' => 'Forbidden Tidak punya akses'
            ], 403);
        }

        return $next($request);
    }
}