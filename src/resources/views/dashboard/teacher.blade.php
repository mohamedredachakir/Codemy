@extends('layouts.app')

@section('content')
<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1>Teacher Dashboard</h1>
        <a href="{{ route('briefs.index') }}" class="btn">Manage All Briefs</a>
    </div>

    @foreach($classes as $class)
        <div style="margin-bottom: 40px; padding: 25px; background: white; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: start; border-bottom: 2px solid #f0f0f0; margin-bottom: 20px; padding-bottom: 10px;">
                <div>
                    <h2 style="margin: 0; color: #333;">{{ $class->name }}</h2>
                    <p style="margin: 5px 0 0 0; color: #888;">{{ $class->students()->count() }} Total Students</p>
                </div>
                <a href="{{ route('briefs.create') }}?class_id={{ $class->id }}" class="btn" style="background: #28a745; color: white;">+ Create New Brief</a>
            </div>

            @php
                $submissions = \App\Models\Submission::whereHas('brief', function($q) use ($class) {
                    $q->where('class_id', $class->id);
                })->with(['student', 'brief.sprint', 'evaluations'])->get();

                $pending = $submissions->filter(fn($s) => $s->evaluations->count() === 0);
                $graded = $submissions->filter(fn($s) => $s->evaluations->count() > 0);
                
                $students = $class->students;
                $studentIdsWithSubmission = $submissions->pluck('student_id')->unique()->toArray();
                $noSubmission = $students->filter(fn($stu) => !in_array($stu->id, $studentIdsWithSubmission));
            @endphp

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                <!-- PENDING SECTION -->
                <div>
                    <h4 style="color: #d9534f; margin-bottom: 15px;">⏳ Pending ({{ $pending->count() }})</h4>
                    @if($pending->isEmpty())
                        <p style="color: #999; font-style: italic; font-size: 0.9rem;">No pending evaluations.</p>
                    @else
                        @foreach($pending as $sub)
                            <div style="padding: 10px; background: #fff5f5; border: 1px solid #ffdfdf; border-radius: 8px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                                <div style="overflow: hidden;">
                                    <strong style="display: block; font-size: 0.9rem; white-space: nowrap; text-overflow: ellipsis;">{{ $sub->student->first_name }} {{ $sub->student->last_name }}</strong>
                                    <small style="color: #666; font-size: 0.75rem;">{{ $sub->brief->title }}</small>
                                </div>
                                <a href="{{ route('evaluations.create', ['submission_id' => $sub->id]) }}" class="btn btn-sm" style="background: #d9534f; color: white; padding: 4px 8px; font-size: 0.7rem;">Grade</a>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- GRADED SECTION -->
                <div>
                    <h4 style="color: #28a745; margin-bottom: 15px;">✅ Graded ({{ $graded->count() }})</h4>
                    @if($graded->isEmpty())
                        <p style="color: #999; font-style: italic; font-size: 0.9rem;">No evaluations completed.</p>
                    @else
                        @foreach($graded as $sub)
                            <div style="padding: 10px; background: #f4fdf4; border: 1px solid #e0f0e0; border-radius: 8px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                                <div style="overflow: hidden;">
                                    <strong style="display: block; font-size: 0.9rem; white-space: nowrap; text-overflow: ellipsis;">{{ $sub->student->first_name }} {{ $sub->student->last_name }}</strong>
                                    <small style="color: #666; font-size: 0.75rem;">{{ $sub->brief->title }}</small>
                                </div>
                                <a href="{{ route('evaluations.show', $sub->brief_id) }}?student_id={{ $sub->student_id }}" class="btn btn-sm" style="background: #28a745; color: white; padding: 4px 8px; font-size: 0.7rem;">View</a>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- NO SUBMISSION SECTION -->
                <div>
                    <h4 style="color: #777; margin-bottom: 15px;">💤 No Submission ({{ $noSubmission->count() }})</h4>
                    @if($noSubmission->isEmpty())
                        <p style="color: #999; font-style: italic; font-size: 0.9rem;">All students have submitted.</p>
                    @else
                        @foreach($noSubmission as $stu)
                            <div style="padding: 10px; background: #f9f9f9; border: 1px solid #eee; border-radius: 8px; margin-bottom: 10px;">
                                <strong style="display: block; font-size: 0.9rem;">{{ $stu->first_name }} {{ $stu->last_name }}</strong>
                                <small style="color: #999; font-size: 0.75rem;">Has not submitted anything yet.</small>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
