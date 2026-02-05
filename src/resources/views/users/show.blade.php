@extends('layouts.app')

@section('content')
<h1>User Details</h1>

<div style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
    <h2>{{ $user->first_name }} {{ $user->last_name }}</h2>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Role:</strong> {{ $user->role }}</p>
    <p><strong>Class:</strong> {{ $user->schoolclass->name ?? 'No class assigned' }}</p>
</div>


<div style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
    <h3>Submissions</h3>
    @if($user->submissions->isEmpty())
        <p>No submissions yet.</p>
    @else
        <ul>
        @foreach($user->submissions as $submission)
            <li>
                <strong>{{ $submission->brief->title ?? 'No brief' }}</strong> -
                Submitted at: {{ $submission->submitted_at->format('Y-m-d H:i') }}
                @if($submission->isLate())
                    <span style="color:red;">(Late)</span>
                @endif
            </li>
        @endforeach
        </ul>
    @endif
</div>


<div style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
    <h3>Evaluations Given</h3>
    @if($user->evaluationsGiven->isEmpty())
        <p>No evaluations given yet.</p>
    @else
        <ul>
        @foreach($user->evaluationsGiven as $evaluation)
            <li>
                <strong>{{ $evaluation->competence->label ?? 'No competence' }}</strong> -
                Level: {{ $evaluation->level }} -
                Comment: {{ $evaluation->comment ?? 'No comment' }} -
                Evaluated at: {{ $evaluation->evaluated_at->format('Y-m-d H:i') }}
            </li>
        @endforeach
        </ul>
    @endif
</div>


<div style="border:1px solid #ccc; padding:10px; margin-bottom:20px;">
    <h3>Evaluations Received</h3>
    @if($user->evaluationsReceived->isEmpty())
        <p>No evaluations received yet.</p>
    @else
        <ul>
        @foreach($user->evaluationsReceived as $evaluation)
            <li>
                <strong>{{ $evaluation->competence->label ?? 'No competence' }}</strong> -
                Level: {{ $evaluation->level }} -
                Comment: {{ $evaluation->comment ?? 'No comment' }} -
                Evaluated at: {{ $evaluation->evaluated_at->format('Y-m-d H:i') }}
            </li>
        @endforeach
        </ul>
    @endif
</div>

<a href="{{ route('users.index') }}">Back to Users List</a>
<a href="{{ route('users.edit', $user->id) }}">Edit User</a>
@endsection
