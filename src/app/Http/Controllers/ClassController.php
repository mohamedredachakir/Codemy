<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = SchoolClass::all();
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = SchoolClass::all();
        return view('classes.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required"
        ]);

        $class = SchoolClass::create([
            "name" => $validated['name']
        ]);

        if($class){
            return redirect()->route("classes.index")->with("succes", "class created!");
        }else { return "error! register class failed!";}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
            $class = SchoolClass::with(['students','teachers'])->findOrFail($id);
            return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!auth()->user()->isAdmin()){
            return redirect()->route('/')
                ->with('error','No access');
        }

        $class = SchoolClass::with(['students','teachers'])->findOrFail($id);

        return view('classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            if(!auth()->user()->isAdmin()){
            return redirect()->route('/')
                ->with('error','No access');
        }

        $class = SchoolClass::find($id);

        $validated = $request->validate([
            "name" => "required"
        ]);

        $class->update($validated);
        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->isAdmin()){
            return redirect()->route('/')
                ->with('error','No access');
        }

        SchoolClass::findOrFail($id)->delete();

        return redirect()->route('classes.index')
            ->with('success', 'Class deleted');
    }

}
