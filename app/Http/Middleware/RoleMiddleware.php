<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Verifica si el usuario tiene uno de los roles permitidos.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Usuario autenticado
        $user = $request->user();

        // Si no hay usuario
        if (!$user) {
            return response()->json([
                'message' => 'No autenticado'
            ], 401);
        }

        // Si el rol NO está permitido
        if (!in_array($user->role, $roles)) {
            return response()->json([
                'message' => 'No tienes permisos para acceder'
            ], 403);
        }

        // Continuar petición
        return $next($request);
    }
}
