<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ValidUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $negocio = DB::select('SELECT id FROM pservicio WHERE id_us = ?', [$request->user()->id]);
        if ($request->user()->tipo_us != 1 & $request->user()->tipo_us != 3) {
            if (empty($negocio)) {
                return redirect()->route('registroDual');
            }
        }
        return $next($request);
    }
}
