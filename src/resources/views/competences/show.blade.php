@extends('layouts.app')

@section('content')
<h1>Competence Details</h1>

<div style="border:1px solid #ccc; padding:15px; margin-bottom:20px;">
    <p><strong>ID:</strong> {{ $competence->id }}</p>
    <p><strong>Code:</strong> {{ $competence->code }}</p>
    <p><strong>Label:</strong> {{ $competence->label }}</p>
</div>

<h3>Sprints related</h3>
@if($competence->sprints->isEmpty())
    <p>No sprints assigned.</p>
@else
    <ul>
        @foreach($competence->sprints as $sprint)
            <li>{{ $sprint->name }} (Duration: {{ $sprint->duration }} | Order: {{ $sprint->order }})</li>
        @endforeach
    </ul>
@endif

<a href="{{ route('competences.index') }}">Back to list</a>
<a href="{{ route('competences.edit', $competence->id) }}">Edit Competence</a>
@endsection
