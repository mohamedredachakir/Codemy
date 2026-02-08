<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $submission = \App\Models\Submission::with(['brief.sprint.competences', 'student'])->findOrFail($request->submission_id);
        $competences = $submission->brief->sprint->competences;

        return view('evaluations.create', compact('submission', 'competences'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'submission_id' => 'required|exists:submissions,id',
            'evaluations' => 'required|array',
            'evaluations.*.competence_id' => 'required|exists:competences,id',
            'evaluations.*.level' => ['required', new \Illuminate\Validation\Rules\Enum(\App\Enums\EvaluationLevelEnum::class)],
            'evaluations.*.comment' => 'nullable|string',
        ]);

        $submission = \App\Models\Submission::with('brief.sprint.competences')->findOrFail($request->submission_id);
        $sprintCompetences = $submission->brief->sprint->competences->pluck('id')->toArray();
        $submittedCompetences = collect($request->evaluations)->pluck('competence_id')->toArray();

        // Check if all competences from the sprint are provided
        if (count(array_diff($sprintCompetences, $submittedCompetences)) > 0) {
            return back()->withErrors(['evaluations' => 'All competences in the sprint must be evaluated.']);
        }

        // Verify teacher belongs to the class of the brief
        $teacher = auth()->user();
        if (!$teacher->teachingclasses->contains($submission->brief->class_id)) {
            return back()->withErrors(['evaluations' => 'You are not authorized to evaluate students in this class.']);
        }

        \DB::transaction(function () use ($request, $submission) {
            foreach ($request->evaluations as $evaluationData) {
                \App\Models\Evaluation::updateOrCreate(
                    [
                        'student_id' => $submission->student_id,
                        'brief_id' => $submission->brief_id,
                        'competence_id' => $evaluationData['competence_id'],
                    ],
                    [
                        'teacher_id' => auth()->id(),
                        'submission_id' => $submission->id,
                        'level' => $evaluationData['level'],
                        'comment' => $evaluationData['comment'],
                        'evaluated_at' => now(),
                    ]
                );
            }
        });

        return redirect()->route('dashboard')->with('success', 'Evaluations saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $brief_id)
    {
        $user = auth()->user();
        
        // If teacher, they might be viewing a specific student's evaluation from a different page
        // If student, they only see their own.
        $studentId = $user->role->value === 'student' ? $user->id : request('student_id');

        $brief = \App\Models\Brief::with('sprint.competences')->findOrFail($brief_id);
        $evaluations = \App\Models\Evaluation::where('brief_id', $brief_id)
            ->where('student_id', $studentId)
            ->with(['competence', 'teacher'])
            ->get();

        if ($evaluations->isEmpty()) {
            return redirect()->route('dashboard')->with('error', 'No evaluations found for this brief.');
        }

        return view('evaluations.show', compact('brief', 'evaluations'));
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
