<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class CheckIsAdmin
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
      if (!$user->isAdmin()){
        session()->flash('warning','Для этой действий вам нужен права Администратора!');
        return redirect()->route('index-html');
      }
        return $next($request);
    }
}
