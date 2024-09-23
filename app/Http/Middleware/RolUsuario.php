<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RolUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 2 formas de ver el rol
        // dd($request->user()->rol);
        // dd(auth()->user()->rol);

        // Verifica que el rol del usuario actual no se 1(dev) y que solo los reclutadores puedan acceder al recurso
        if (auth()->user()->rol === 1) {
            return redirect()->route('home');
        }

        return $next($request);
    }
}
