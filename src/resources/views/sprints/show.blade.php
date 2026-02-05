@extends('layouts.app')

@section('content')

<h1>Sprint Details</h1>

<div style="border:1px solid #ccc; padding:15px; margin-bottom:20px;">
    <h2>{{ $sprint->name }}</h2>
    <p><strong>Duration:</strong> {{ $sprint->duration }}</p>
    <p><strong>Order:</strong> {{ $sprint->order }}</p>
</div>

<h3>Classes using this Sprint</h3>

@if($sprint->classes->isEmpty())
    <p>No classes assigned</p>
@else
    <ul>
        @foreach($sprint->classes as $class)
            <li>{{ $class->name }}</li>
        @endforeach
    </ul>
@endif

<a href="{{ route('sprints.index') }}">Back</a>
<a href="{{ route('sprints.edit', $sprint->id) }}">Edit</a>

@endsection
