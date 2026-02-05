@extends('layouts.app')

@section('content')
<h1>Assign Users to Classes</h1>

<h2>Assign Teacher</h2>
<form action="{{ route('assign.teacher') }}" method="POST">
    @csrf
    <label>Class</label>
    <select name="class_id">
        @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }}</option>
        @endforeach
    </select>

    <label>Teacher</label>
    <select name="teacher_id">
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
        @endforeach
    </select>

    <button type="submit">Assign Teacher</button>
</form>

<hr>

<h2>Assign Student</h2>
<form action="{{ route('assign.student') }}" method="POST">
    @csrf
    <label>Class</label>
    <select name="class_id">
        @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->name }}</option>
        @endforeach
    </select>

    <label>Student</label>
    <select name="student_id">
        @foreach($students as $student)
            <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
        @endforeach
    </select>

    <button type="submit">Assign Student</button>
</form>

@endsection
