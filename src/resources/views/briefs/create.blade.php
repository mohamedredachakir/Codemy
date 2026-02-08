@extends('layouts.app')

@section('content')
<h1>Create Brief for Class: {{ $class->name }}</h1>

<form action="{{ route('briefs.store') }}" method="POST">
    @csrf

    <!-- Hidden field to pass class_id -->
    <input type="hidden" name="class_id" value="{{ $class->id }}">

    <!-- Teacher ID (current logged-in teacher) -->
    <input type="hidden" name="teacher_id" value="{{ auth()->id() }}">

    <div>
        <label>Title</label>
        <input type="text" name="title" value="{{ old('title') }}" required>
    </div>

    <div>
        <label>Description</label>
        <textarea name="description" required>{{ old('description') }}</textarea>
    </div>

    <div>
        <label>Estimated Time (hours)</label>
        <input type="number" name="estimated_time" value="{{ old('estimated_time') }}" required>
    </div>

    <div>
        <label>Type</label>
        <select name="type" required>
            <option value="{{ \App\Enums\BriefTypeEnum::INDIVIDUAL }}">Individual</option>
            <option value="{{ \App\Enums\BriefTypeEnum::GROUP }}">Group</option>
        </select>
    </div>

    <div>
        <label>Sprint</label>
        <select name="sprint_id" required>
            @foreach($sprints as $sprint)
                <option value="{{ $sprint->id }}">{{ $sprint->name }} ({{ $sprint->duration }} days)</option>
            @endforeach
        </select>
    </div>

    <div>
        <label>
            <input type="checkbox" name="is_published" value="1"> Publish immediately
        </label>
    </div>

    <button type="submit">Create Brief</button>
</form>
@endsection
