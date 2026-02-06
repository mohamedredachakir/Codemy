@extends('layouts.app')

@section('content')

<h1>Edit Brief</h1>

<form action="{{ route('briefs.update', $brief->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Title</label>
        <input type="text" name="title" value="{{ old('title', $brief->title) }}">
    </div>

    <div>
        <label>Description</label>
        <textarea name="description">{{ old('description', $brief->description) }}</textarea>
    </div>

    <div>
        <label>Sprint</label>
        <select name="sprint_id">
            @foreach($sprints as $sprint)
                <option value="{{ $sprint->id }}"
                    {{ $brief->sprint_id == $sprint->id ? 'selected' : '' }}>
                    {{ $sprint->name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit">Update Brief</button>

</form>

@endsection
