@extends('layouts.app')

@section('content')
<h1>All Your Briefs</h1>

@foreach($briefs as $brief)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <h3>{{ $brief->title }}</h3>
        <p>{{ $brief->description }}</p>
        <p>Estimated time: {{ $brief->estimated_time }} days</p>
        <p>Class: {{ $brief->schoolclass->name }}</p>
        <a href="{{ route('briefs.edit', $brief->id) }}">Edit Brief</a>
        <a href="{{ route('briefs.show', $brief->id) }}">Evaluate</a>
    </div>
@endforeach
@endsection
