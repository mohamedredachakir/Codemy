@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Submit Solution for: {{ $brief->title }}</h2>
    <p><strong>Sprint:</strong> {{ $brief->sprint->name }}</p>
    <p><strong>Description:</strong> {{ $brief->description }}</p>

    <form method="POST" action="{{ route('submissions.store') }}">
        @csrf
        <input type="hidden" name="brief_id" value="{{ $brief->id }}">

        <div class="form-group">
            <label for="content">Your Solution (Link or Text):</label>
            <textarea name="content" id="content" class="form-control" rows="10" required placeholder="Enter your GitHub repo link or solution text here..."></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit My Work</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
