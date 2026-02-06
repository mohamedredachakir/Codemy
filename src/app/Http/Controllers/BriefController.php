<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use App\Models\SchoolClass;
use App\Models\Sprint;
use Illuminate\Http\Request;
use App\Enums\BriefTypeEnum;

class BriefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $briefs = Brief::with('sprint')->get();
        return view('briefs.index', compact('briefs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $class = SchoolClass::findOrFail($request->class_id);
        $sprints = Sprint::all();
        return view('briefs.create', compact('sprints','class'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'sprint_id' => 'required|exists:sprints,id',
        'estimated_time' => 'required|integer|min:1',
        'type' => 'required|in:individual,group',
        'class_id' => 'exists:school_classes,id',
        ]);

        Brief::create([
        'title' => $request->title,
        'description' => $request->description,
        'sprint_id' => $request->sprint_id,
        'estimated_time' => $request->estimated_time,
        'type' => BriefTypeEnum::from($request->type),
        'class_id' => $request->class_id,
        'teacher_id' => auth()->id(),
        ]);
            return redirect()->route('dashboard')
        ->with('success','Brief created successfully');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
