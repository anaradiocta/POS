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
    public function handle(Request $request, Closure $next, ... $role): Response
    {
        $user_role = $request->user()->getRole();   //ambil data user yang login
        if(in_array ($user_role, $role)){  //cek apakah user punya role yang diinginkan
            return $next($request);
        }
        //jika tidak punya role, maka tampilkan error 403
        abort(403,'Forbidden, kamu tidak punya kases ke halaman ini');
    }
}
