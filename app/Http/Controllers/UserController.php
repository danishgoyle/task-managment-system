<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Session;
use Config;
use Validator;
use JWTAuth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function test()
    {
        return "Working fine.";
    }

    public function register()
    {
        
        return view('users.register');
    }

    public function  loginForm()
    {
        return view ('users.login');
    }

    //Sign Up Registration
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password =  Hash::make($request->password);
        $data->save();

        return redirect()->route('login')->with('success', 'User registered successfully.');
    }

    public function login(Request $request){
        $user   = User::where("email" , $request->email)->first();
            if(!$user) {
                return redirect()->route('login')->with('error', 'User not found');
            } 
        
        if(!Hash::check($request->password, $user->password))  {
            return redirect()->route('login')->with('error', 'Password Incorrect.');
        }
        
        Config::set('auth.providers.users.model',\App\Models\User::class); 
        Config::set('auth.providers.users.table', 'users');
        //Config::set('jwt.user', OtherUser::class);      
        if (! $token = JWTAuth::fromUser($user)) {
                
            return redirect()->route('login')->with('error', 'Something went wrong');
        }  
        session(['jwt_token' => $token]);

        
        return redirect()->route('tasks.index');
    }

    public function logout(){

        $token = session('jwt_token');
        JWTAuth::setToken($token);
        $user = JWTAuth::toUser();

        Session::forget($token);
        JWTAuth::invalidate();
        return redirect()->route('login');
    }


}
