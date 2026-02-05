@extends('layouts.app')

@section('content')

<h1>Class Details</h1>

<div style="border:1px solid #ccc; padding:15px; margin-bottom:20px;">
    <h2>{{ $class->name }}</h2>
</div>

<h3>Students in this Class</h3>

@if($class->student->isEmpty())
    <p>No students assigned</p>
@else
    <ul>
        @foreach($class->student as $user)
            <li>
                {{ $user->first_name }} {{ $user->last_name }} - {{ $user->email }}
            </li>
        @endforeach
    </ul>
@endif

<br>

<a href="{{ route('classes.index') }}">Back</a>
<a href="{{ route('classes.edit', $class->id) }}">Edit Class</a>

@endsection
