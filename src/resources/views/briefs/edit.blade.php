@extends('layouts.app')

@section('content')

<form action="{{ route('briefs.update', $brief->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Title</label>
    <input type="text" name="title" value="{{ $brief->title }}">

    <label>Class</label>
    <select name="class_id">
        @foreach($classes as $class)
            <option value="{{ $class->id }}" @selected($brief->class_id == $class->id)>
                {{ $class->name }}
            </option>
        @endforeach
    </select>

    <label>Description</label>
    <textarea name="description">{{ $brief->description }}</textarea>

    <label>Estimated Time (days)</label>
    <input type="number" name="estimated_time" value="{{ $brief->estimated_time }}">

        <label>Type</label>
        <select name="type" required>
            <option value="{{ \App\Enums\BriefTypeEnum::INDIVIDUAL }}">Individual</option>
            <option value="{{ \App\Enums\BriefTypeEnum::GROUP }}">Group</option>
        </select>
        <label>Sprint</label>
        <select name="sprint_id" required>
            @foreach($sprints as $sprint)
                <option value="{{ $sprint->id }}">{{ $sprint->name }} ({{ $sprint->duration }} days)</option>
            @endforeach
        </select>
    </div>



    <button type="submit">Update Brief</button>
</form>
@endsection
