<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentAdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user || ($user->role !== 'student' && $user->role !== 'admin')) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
