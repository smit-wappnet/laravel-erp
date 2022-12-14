<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{    
    public function dashboard(){
        return view('dashboard');
    }

    public function signin_view()
    {
        return view("auth.signin");
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            return redirect()->route('dashboard');
        }

        return redirect()->route("auth.signin")->withErrors("Error");

    }

    public function signup_view()
    {
        return view("auth.signup");
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if(Auth::attempt($request->only('email', 'password'))){
            return redirect()->route('dashboard');
        }

        return redirect()->route("auth.signup")->withErrors("Error");
    }

    public function signout(){
        Session::flush();
        Auth::logout();
        return redirect(url("/"));
    }
}
