@extends('layouts.app')

@section('content')
<h1>Admin Dashboard</h1>

<a href="{{ route('users.index') }}">Manage Users</a>
<a href="{{ route('classes.index') }}">Manage Classes</a>
<a href="{{ route('sprints.index') }}">Manage Sprints</a>
<a href="{{ route('competences.index') }}">Manage Competences</a>
<a href="{{ route('assign.index') }}" style="background:purple; color:white; padding:5px 10px; text-decoration:none;">Assign</a>
@endsection
