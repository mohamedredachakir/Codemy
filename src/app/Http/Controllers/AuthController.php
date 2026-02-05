<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(){
           return view("auth.login");
    }

    public function login(Request $request){
           $credentails = $request->validate([
            "email" => "required|email",
            "password" => "required"
           ]);
           if(Auth::attempt($credentails)){
            $request->session()->regenerate(); 
            return redirect()->route("dashboard")->with("login","seccsus!!");
           }else{
            return "error login!";
           }
    }

    public function logout(){
          Auth::logout();
          return redirect("/login")->with("logouted","true!");
    }
}
