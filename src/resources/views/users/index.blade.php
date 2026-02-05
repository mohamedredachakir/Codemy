@extends('layouts.app')

@section('content')


<div style="margin-bottom:20px;">
    <a href="{{ route('users.create') }}" style="padding:10px; background:green; color:white; text-decoration:none;">Create User</a>
</div>

<h1>Users List</h1>

<table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Class</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->schoolclass->name ?? 'No class' }}</td>
            <td>
                <a href="{{ route('users.show', $user->id) }}" style="padding:5px; background:blue; color:white; text-decoration:none;">Show</a>
                <a href="{{ route('users.edit', $user->id) }}" style="padding:5px; background:orange; color:white; text-decoration:none;">Edit</a>


                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="padding:5px; background:red; color:white; border:none;" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
