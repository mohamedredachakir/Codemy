@extends('layouts.app')

@section('content')
<h1>Create Competence</h1>

<form action="{{ route('competences.store') }}" method="POST">
    @csrf
    <div>
        <label>Code:</label>
        <input type="number" name="code" value="{{ old('code') }}" required>
        @error('code') <div style="color:red;">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Label:</label>
        <input type="text" name="label" value="{{ old('label') }}" required>
        @error('label') <div style="color:red;">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>

<a href="{{ route('competences.index') }}">Back to list</a>
@endsection
