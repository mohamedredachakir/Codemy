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
    public function index(Request $request)
    {
        $teacher = auth()->user();
        $query = Brief::whereIn('class_id', $teacher->teachingclasses->pluck('id'));

        if ($request->has('class_id')) {
            $query->where('class_id', $request->class_id);
        }

        $briefs = $query->with('schoolclass')->get();
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
        'is_published' => 'nullable|boolean',
        ]);

        Brief::create([
        'title' => $request->title,
        'description' => $request->description,
        'sprint_id' => $request->sprint_id,
        'estimated_time' => $request->estimated_time,
        'type' => BriefTypeEnum::from($request->type),
        'class_id' => $request->class_id,
        'teacher_id' => auth()->id(),
        'is_published' => $request->has('is_published'),
        ]);
            return redirect()->route('dashboard')
        ->with('success','Brief created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
            if(!auth()->user()->isTeacher()){
            return redirect()->route('/')
                ->with('error','No access');
        }

        $brief = Brief::findOrFail($id);
        if ($brief->teacher_id != auth()->id()) {
             return redirect()->route('dashboard')->with('error', 'You can only edit your own briefs.');
        }
        $sprints = Sprint::all();
        $classes = auth()->user()->teachingclasses;
        return view('briefs.edit', compact('brief', 'classes', 'sprints'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            if(!auth()->user()->isTeacher()){
            return redirect()->route('/')
                ->with('error','No access');
        }

        $brief = Brief::findOrFail($id);
        if ($brief->teacher_id != auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You can only update your own briefs.');
        }

        $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'sprint_id' => 'required|exists:sprints,id',
        'estimated_time' => 'required|integer|min:1',
        'type' => 'required|in:individual,group',
        'class_id' => 'exists:school_classes,id',
        'is_published' => 'nullable|boolean',
        ]);


        $brief->update([
        'title' => $request->title,
        'description' => $request->description,
        'sprint_id' => $request->sprint_id,
        'estimated_time' => $request->estimated_time,
        'type' => BriefTypeEnum::from($request->type),
        'class_id' => $request->class_id,
        'teacher_id' => auth()->id(),
        'is_published' => $request->has('is_published'),
        ]);
        return redirect()->route('dashboard')
        ->with('success','Brief updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            if(!auth()->user()->isTeacher()){
            return redirect()->route('/')
                ->with('error','No access');
        }

        $brief = Brief::findOrFail($id);
        if ($brief->teacher_id != auth()->id()) {
            return redirect()->route('dashboard')->with('error', 'You can only delete your own briefs.');
        }

        $brief->delete();
                return redirect()->route('dashboard')
        ->with('success','Brief deleted successfully');
    }
}
