@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Evaluation Results: {{ $brief->title }}</h2>
    <p><strong>Sprint:</strong> {{ $brief->sprint->name }}</p>

    <div class="evaluation-summary" style="margin-top: 20px;">
        <table class="table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #eee;">
                    <th style="text-align: left; padding: 10px;">Competence</th>
                    <th style="text-align: left; padding: 10px;">Level</th>
                    <th style="text-align: left; padding: 10px;">Teacher Comment</th>
                    <th style="text-align: left; padding: 10px;">Evaluated By</th>
                </tr>
            </thead>
            <tbody>
                @foreach($evaluations as $evaluation)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;">
                        <strong>{{ $evaluation->competence->code }}</strong>: {{ $evaluation->competence->label }}
                    </td>
                    <td style="padding: 10px;">
                        <span class="badge" style="background: #333; color: white; text-transform: uppercase;">
                            {{ $evaluation->level }}
                        </span>
                    </td>
                    <td style="padding: 10px;">
                        {{ $evaluation->comment ?? 'No comment provided.' }}
                    </td>
                    <td style="padding: 10px;">
                        {{ $evaluation->teacher->first_name }} {{ $evaluation->teacher->last_name }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ route('dashboard') }}" class="btn">Back to Dashboard</a>
    </div>
</div>
@endsection
