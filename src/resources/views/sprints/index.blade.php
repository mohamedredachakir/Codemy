@extends('layouts.app')

@section('content')

<h1>Sprints List</h1>

<a href="{{ route('sprints.create') }}">Create Sprint</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Duration</th>
            <th>Order</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($sprints as $sprint)
        <tr>
            <td>{{ $sprint->id }}</td>
            <td>{{ $sprint->name }}</td>
            <td>{{ $sprint->duration }}</td>
            <td>{{ $sprint->order }}</td>

            <td>
                <a href="{{ route('sprints.show', $sprint->id) }}">Show</a>
                <a href="{{ route('sprints.edit', $sprint->id) }}">Edit</a>

                <form action="{{ route('sprints.destroy', $sprint->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
