@extends('layouts.app')

@section('content')

<h1>Edit Class</h1>

<form action="{{ route('classes.update', $class->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Class Name</label>
        <input type="text" name="name" value="{{ old('name', $class->name) }}">
    </div>

    <br>

    <button type="submit">Update Class</button>
</form>

<a href="{{ route('classes.index') }}">Back</a>

@endsection
