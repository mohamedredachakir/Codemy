@extends('layouts.app')

@section('content')
<h1>Create User</h1>

<form action="{{ route('classes.store') }}" method="POST">
    @csrf

    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}">
    </div>
    <button type="submit">Create User</button>
</form>
@endsection
