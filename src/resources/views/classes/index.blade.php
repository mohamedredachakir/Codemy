@extends('layouts.app')

@section('content')
<h1>Classes List</h1>

<a href="{{ route('classes.create') }}" style="margin-bottom:10px; display:inline-block;">Create Class</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th> 
        </tr>
    </thead>
    <tbody>
        @foreach($classes as $class)
        <tr>
            <td>{{ $class->id }}</td>
            <td>{{ $class->name }}</td>
            <td>

                <a href="{{ route('classes.show', $class->id) }}" style="margin-right:5px;">Show</a>


                <a href="{{ route('classes.edit', $class->id) }}" style="margin-right:5px;">Edit</a>


                <form action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this class?');">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
