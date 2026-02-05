@extends('layouts.app')

@section('content')
<h1>Edit Competence</h1>

<form action="{{ route('competences.update', $competence->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label>Code:</label>
        <input type="number" name="code" value="{{ old('code', $competence->code) }}" required>
        @error('code') <div style="color:red;">{{ $message }}</div> @enderror
    </div>
    <div>
        <label>Label:</label>
        <input type="text" name="label" value="{{ old('label', $competence->label) }}" required>
        @error('label') <div style="color:red;">{{ $message }}</div> @enderror
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>

<a href="{{ route('competences.index') }}">Back to list</a>
@endsection
