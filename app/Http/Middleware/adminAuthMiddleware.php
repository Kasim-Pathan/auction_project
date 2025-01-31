<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Auth;

class adminAuthMiddleware
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
        if($data->role != 'admin'){
            return back()->with('fail', 'you can not aceess this route');
        }
        return $next($request);
    }
}
