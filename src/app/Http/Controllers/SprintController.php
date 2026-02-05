<?php

namespace App\Http\Controllers;

use App\Models\Sprint;
use Illuminate\Http\Request;

            // $table->string('name');
            // $table->integer('duration');
            // $table->integer('order');

class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sprints = Sprint::all();
        return view('sprints.index', compact('sprints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sprints.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'duration' => 'required|integer',
            'order' => 'required|integer'
        ]);

        $sprint = Sprint::create([
            'name' => $validated['name'],
            'duration' => $validated['duration'],
            'order' => $validated['order']
        ]);

        if($sprint){
            return redirect()->route('sprints.index')->with('succes', 'sprints created!');
        }else {return 'error! create sprint failed!!';}
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sprint = Sprint::with(['classes'])->find($id);
        return view('sprints.show', compact('sprint'));
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

        $sprint = Sprint::with(['classes'])->find($id);
        return view('sprints.edit', compact('sprint'));
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

        $sprint = Sprint::find($id);

        $validated = $request->validate([
            'name' => 'required',
            'duration' => 'required',
            'order' => 'required'
        ]);

        $sprint->update($validated);
        return redirect()->route('sprints.index')
        ->with('success', 'Sprint updated');

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

        Sprint::find($id)->delete();
        return redirect()->route('sprints.index')->with('success', 'sprint delete!');
    }
}
