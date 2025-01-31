<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Middleware\adminAuthMiddleware;

class authanticationController extends Controller
{
    
    // Handle Login
    function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $loginCheck = array('email' => $request->email,
        'password' => $request->password
        );
        $loginCheck = Auth::attempt($loginCheck);
        
        $data = User::where('id','=',Auth::id())->first();
        // dd($data->toArray());
        if($data->role == 'admin'){
            // dd('admin panel');
            return redirect()->route('admin.dashboard');
        }
        elseif($data->role == 'user'){
            // dd('user panle');
            return redirect()->route('user.dashboard');
        }
        else{
            return back()->with('fail', 'Invalid Credentials');
        }
    } 
    function registration(Request $request){
        dd($request->toArray());
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12',
            'role' => 'required'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $query = $user->save();
        if($query){
            return back()->with('success', 'You have been successfully registered');
        }
        else{
            return back()->with('fail', 'Something went wrong');
        }
    }

    function logout (){
        Auth::logout();
        return redirect()->route('loginView');
    }
}
