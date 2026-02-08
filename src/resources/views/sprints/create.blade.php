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
    <label>Competences</label>

<select name="competences[]" multiple class="form-control">

@foreach($competences as $competence)
    <option value="{{ $competence->id }}">
        {{ $competence->label }}
    </option>
@endforeach

</select>


    <button type="submit">Create</button>
</form>

<a href="{{ route('sprints.index') }}">Back</a>

@endsection
