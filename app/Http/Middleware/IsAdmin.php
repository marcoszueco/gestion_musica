<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next):mixed
    {
        // Verificamos si el usuario está logueado Y si tiene el método isAdmin que creamos antes
        if (auth()->check() && auth()->user()->isAdmin()) {
            return $next($request); // ¡Adelante, pase usted!
        }

        // Tarea 5: Redirección apropiada si no es admin
        return redirect('/dashboard')->with('error', 'No tienes permisos de administrador.');
    }
}
