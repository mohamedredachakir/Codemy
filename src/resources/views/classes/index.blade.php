@extends('layouts.app')

@section('content')
<h1>Classes List</h1>

<a href="{{ route('classes.create') }}">Create Class</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $class)
        <tr>
            <td>{{ $class->id }}</td>
            <td>{{ $class->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
