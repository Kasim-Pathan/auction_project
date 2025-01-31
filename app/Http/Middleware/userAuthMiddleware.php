<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\User;

class userAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
                
        if(!Auth::check()){
            return redirect()->route('loginView');
        }
        // dd(auth::User()->toarray());
        $data = User::where('id','=',Auth::id())->first();
        if($data->role != 'user'){
            return back()->with('fail', 'Invalid Credentials');
        }
        return $next($request);
    }
}
