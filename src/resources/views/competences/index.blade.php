@extends('layouts.app')

@section('content')
<h1>Competences List</h1>

<a href="{{ route('competences.create') }}" class="btn btn-primary">Create Competence</a>

<table border="1" cellpadding="10" style="margin-top:15px; border-collapse: collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Label</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($competences as $competence)
        <tr>
            <td>{{ $competence->id }}</td>
            <td>{{ $competence->code }}</td>
            <td>{{ $competence->label }}</td>
            <td>
                <a href="{{ route('competences.show', $competence->id) }}" class="btn btn-info">Show</a>
                <a href="{{ route('competences.edit', $competence->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('competences.destroy', $competence->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No competences found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
