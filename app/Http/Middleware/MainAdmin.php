<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MainAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (!$user->MainAdmin()){
            session()->flash('warning','Для этой действий вам нужен права Главного Админа!');
            return redirect()->route('index-html');
        }
        return $next($request);
    }
}
