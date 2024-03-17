<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            session()->flash('error', 'Silahkan Login Terlebih dahulu');
            return redirect()->route('home.index');
        }

        $user = Auth::user();

        if($user->level == $role){
            return $next($request);
        }

        session()->flash('error', 'Kamu Tidak Punya Hak Akses');
        return redirect()->route('home.index');

    }
}
