<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('schoolclass')->latest()->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = SchoolClass::all();
        return view("users.create", compact('classes'));
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
            "class_id" => "nullable|exists:classes,id" ,
        ]);

        $user = User::create([
            "first_name"=> $validated["first_name"],
            "last_name"=> $validated["last_name"],
            "email"=> $validated["email"],
            "password"=> Hash::make($validated["password"]),
            "role"=> $validated["role"] ?? UserRole::STUDENT,
            "class_id"=> $validated["class_id"] ?? null,
        ]);

        if($user){
            return redirect()->route("users.index")->with("success","user created!");
        }else {return 'error! register failed!';}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['schoolclass','submissions','evaluationsGiven','evaluationsReceived'])->find($id);
        return view("users.show", compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!auth()->user()->isAdmin()){
            return redirect()->route('users.index')
                ->with('error','No access');
        }

        $user = User::findOrFail($id);
        $classes = SchoolClass::all();

        return view("users.edit", compact('user','classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!auth()->user()->isAdmin()){
            abort(403);
        }

        $user = User::findOrFail($id);

        $validate = $request->validate([
            'first_name'=> 'required',
            'last_name'=> 'required',
            'email'=> 'required|email|unique:users,email,' . $id,
            'password'=> 'nullable|confirmed',
            'class_id' => 'nullable|exists:classes,id'
        ]);

        if($request->filled('password')){
            $validate['password'] = Hash::make($request->password);
        }else{
            unset($validate['password']);
        }

        $user->update($validate);

        return redirect()->route('users.index')
            ->with('success','User updated');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->isAdmin()){
            abort(403);
        }

        User::findOrFail($id)->delete();

        return redirect()->route('users.index')
            ->with('success','User deleted');
    }

}
