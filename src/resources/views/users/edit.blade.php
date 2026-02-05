@extends('layouts.app')

@section('content')
<h1>Edit User</h1>

<form action="{{ route('users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>First Name</label>
        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}">
    </div>

    <div>
        <label>Last Name</label>
        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}">
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}">
    </div>

    <div>
        <label>Password (leave blank if no change)</label>
        <input type="password" name="password">
    </div>

    <div>
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation">
    </div>


    <div>
        <label>Role</label>
        <select name="role">
            <option value="{{ \App\Enums\UserRole::STUDENT }}" {{ $user->role == \App\Enums\UserRole::STUDENT ? 'selected' : '' }}>Student</option>
            <option value="{{ \App\Enums\UserRole::TEACHER }}" {{ $user->role == \App\Enums\UserRole::TEACHER ? 'selected' : '' }}>Teacher</option>
            <option value="{{ \App\Enums\UserRole::ADMIN }}" {{ $user->role == \App\Enums\UserRole::ADMIN ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <button type="submit">Update User</button>
</form>
@endsection
