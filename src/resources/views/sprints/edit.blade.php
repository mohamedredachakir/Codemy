@extends('layouts.app')

@section('content')

<h1>Edit Sprint</h1>

<form action="{{ route('sprints.update', $sprint->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label>Name</label>
        <input type="text" name="name" value="{{ $sprint->name }}" required>
    </div>

    <div>
        <label>Duration</label>
        <input type="number" name="duration" value="{{ $sprint->duration }}" required>
    </div>

    <div>
        <label>Order</label>
        <input type="number" name="order" value="{{ $sprint->order }}" required>
    </div>

    <button type="submit">Update</button>
</form>

<a href="{{ route('sprints.index') }}">Back</a>

@endsection
