<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

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
        if($data->role == 'admin'){
            return redirect()->route('admin.dashboard');
        }
        elseif($data->role == 'user'){
            return redirect()->route('user.dashboard');
        }
        else{
            return back()->with('fail', 'Invalid Credentials');
        }
    } 

    function registration(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:12',
        
        ]);
        // dd($request->toArray());
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $query = $user->save();
        if($query){
            return redirect()->route('loginView')->with('success', 'Registration Successful');
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
