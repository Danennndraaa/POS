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
    public function handle(Request $request, Closure $next, $role = ''): Response
    {
        $user = $request->user(); // mendapatkan user yang sedang login
                                    //fungsi user() diambil dari UserModel.php
        if($user->hasRole($role)) { //cek apakah user memiliki role yang diinginkan
            return $next($request);
        }
        
        //jika tidak memiliki role, maka tampilkan error 403
        abort(403, 'Anda tidak memiliki akses ke halaman ini');
        
    }
}
