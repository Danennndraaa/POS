<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $roles): Response
    {
        $user_role = $request->user()->getRole(); //ambil data level_kode dari user yg login
                                    
        if(in_array($user_role, $roles)) { //cek apakah level_kode user ada di dalam array roles
            return $next($request); //jika ada, maka lanjutkan request
        }
        
        //jika tidak memiliki role, maka tampilkan error 403
        abort(403, 'Anda tidak memiliki akses ke halaman ini');
        
    }
}
