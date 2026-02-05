@extends('layouts.app')

@section('content')

<h1>Create Sprint</h1>

<form action="{{ route('sprints.store') }}" method="POST">
    @csrf

    <div>
        <label>Name</label>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Duration</label>
        <input type="number" name="duration" required>
    </div>

    <div>
        <label>Order</label>
        <input type="number" name="order" required>
    </div>

    <button type="submit">Create</button>
</form>

<a href="{{ route('sprints.index') }}">Back</a>

@endsection
