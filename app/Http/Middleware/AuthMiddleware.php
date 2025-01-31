<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\User;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(!Auth::check()){
            return redirect()->route('showlogin');
        }
        $data = User::where('id','=',Auth::id())->first();
        // dd($data->toArray());
        if($data->role != 'admin'){
            return redirect()->route('aution');
        }
        return $next($request);
    }
}
