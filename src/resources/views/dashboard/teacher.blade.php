@extends('layouts.app')

@section('content')
<h1>Teacher Dashboard</h1>

<h2>Your Classes</h2>

@foreach($classes as $class)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <h3>{{ $class->name }}</h3>

        {{-- Button for creating brief --}}
        <a href="{{ route('briefs.create') }}?class_id={{ $class->id }}" style="margin-right:10px;">
            Create Brief
        </a>

        {{-- Button to see all briefs for this class --}}
        <a href="{{ route('briefs.index') }}?class_id={{ $class->id }}">
            View All Briefs
        </a>

        {{-- Button to evaluate --}}
        <a href="{{ route('evaluations.index') }}?class_id={{ $class->id }}">
            Evaluate Students
        </a>

        {{-- List all briefs for this class --}}
        <h4>Briefs:</h4>
        <ul>
            @foreach($class->briefs as $brief)
                <li>
                    <a href="{{ route('briefs.show', $brief->id) }}">
                        {{ $brief->title }}
                    </a>
                    {{-- Optional: edit brief --}}
                    <a href="{{ route('briefs.edit', $brief->id) }}" style="margin-left:10px;">
                        Edit
                    </a>
                </li>
            @endforeach
            @if($class->briefs->isEmpty())
                <li>No briefs yet.</li>
            @endif
        </ul>
    </div>
@endforeach

@endsection
