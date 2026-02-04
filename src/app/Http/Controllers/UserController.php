<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
            "role"=> "nullable",
        ]);

        $user = User::create([
            "first_name"=> $validated["first_name"],
            "last_name"=> $validated["last_name"],
            "email"=> $validated["email"],
            "password"=> Hash::make($validated["password"]),
            "role"=> $validated["role"] ?? "user",
            "class_id"=> $validated["class_id"] ?? null,
        ]);

        if($user){
            return redirect()->route("")->with("success","user created!");
        }else {return 'error! register failed!';}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($request, string $id)
    {
        if(Auth::user()->role !== 'admin'){
            return redirect('')->with('error','');
        }else{
            return view("");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $validate = $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required|confirmed',
            'role'=> 'nullable',
        ]);
        if(Auth::user()->role !== 'admin'){
           abort(403);
           return redirect();
        }else{
             $user = User::find($id);
            $user->update($validate);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::user()->role !== 'admin'){
            return redirect('')->with('error','');
        }else {
            $user = User::find($id);
            if($user){
                $user->delete();
            }

        }
    }
}
