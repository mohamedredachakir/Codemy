@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Student Dashboard</h1>

    @if(isset($error))
        <div class="alert alert-error">{{ $error }}</div>
    @else
        <div class="class-info" style="margin-bottom: 25px; padding: 15px; background: #f9f9f9; border-radius: 8px; border-left: 5px solid #333;">
            <h2 style="margin:0;">Class: {{ $user->schoolclass->name }}</h2>
            <p style="margin:5px 0 0 0; color: #666;">Welcome back, {{ $user->first_name }}!</p>
        </div>

        <h3>Your Briefs</h3>

        @if($briefs->isEmpty())
            <p>No briefs have been published for your class yet.</p>
        @else
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px;">
                @foreach($briefs as $brief)
                <div style="border:1px solid #eee; padding:20px; border-radius: 12px; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.05); position: relative;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 10px;">
                        <h4 style="margin:0; font-size: 1.2rem;">{{ $brief->title }}</h4>
                        <span class="badge" style="background: #efefef; color: #333; font-size: 0.8rem;">{{ $brief->sprint->name }}</span>
                    </div>

                    <p style="color: #555; line-height: 1.5; margin-bottom: 15px;">
                        {{ $brief->description }}
                    </p>

                    <div style="margin-bottom: 20px; font-size: 0.9rem; color: #777;">
                        <span>⏱ Estimated: {{ $brief->estimated_time }} hours</span>
                        <span style="margin-left: 15px;">👥 Type: {{ ucfirst($brief->type->value) }}</span>
                    </div>

                    <div style="display: flex; align-items: center; gap: 10px;">
                        @if($brief->submissions->count() > 0)
                            <span class="badge" style="background: #dff0d8; color: #3c763d; padding: 8px 12px;">✅ Submitted</span>
                            @php 
                                $isEvaluated = \App\Models\Evaluation::where('student_id', auth()->id())
                                    ->where('brief_id', $brief->id)
                                    ->exists(); 
                            @endphp
                            @if($isEvaluated)
                                <a href="{{ route('evaluations.show', $brief->id) }}" class="btn" style="background: #333; color: white;">View Results</a>
                            @else
                                <span style="font-size: 0.85rem; color: #999; font-style: italic;">Awaiting Teacher Review</span>
                            @endif
                        @else
                            <a href="{{ route('submissions.create', ['brief_id' => $brief->id]) }}" class="btn" style="background: #007bff; color: white;">Submit Solution</a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    @endif
</div>
@endsection
