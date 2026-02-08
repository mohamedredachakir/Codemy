<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $submissions = auth()->user()->submissions()->with('brief')->get();
        return view('student.index', compact('submissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $brief = \App\Models\Brief::where('is_published', true)->findOrFail($request->brief_id);
        return view('student.submit', compact('brief'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brief_id' => 'required|exists:briefs,id',
            'content' => 'required|string',
        ]);

        $exists = \App\Models\Submission::where('student_id', auth()->id())
            ->where('brief_id', $request->brief_id)
            ->exists();

        if ($exists) {
            return back()->withErrors(['brief_id' => 'You have already submitted for this brief.']);
        }

        $brief = \App\Models\Brief::where('is_published', true)->find($request->brief_id);
        if (!$brief) {
             return redirect()->route('dashboard')->with('error', 'Unpublished brief.');
        }

        \App\Models\Submission::create([
            'student_id' => auth()->id(),
            'brief_id' => $request->brief_id,
            'content' => $request->content,
            'submitted_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Submitted successfully');
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
