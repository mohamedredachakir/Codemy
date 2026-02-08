@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Evaluate Submission: {{ $submission->student->first_name }} {{ $submission->student->last_name }}</h2>
    <p><strong>Brief:</strong> {{ $submission->brief->title }}</p>
    <p><strong>Content:</strong></p>
    <div class="well" style="background: #f9f9f9; padding: 15px; border-radius: 4px; border: 1px solid #ddd; margin-bottom: 20px;">
        {{ $submission->content }}
    </div>

    <form method="POST" action="{{ route('evaluations.store') }}">
        @csrf
        <input type="hidden" name="submission_id" value="{{ $submission->id }}">

        <h3>Competences Check</h3>
        <table class="table" style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
            <thead>
                <tr style="border-bottom: 2px solid #eee;">
                    <th style="text-align: left; padding: 10px;">Competence</th>
                    <th style="text-align: left; padding: 10px;">Level</th>
                    <th style="text-align: left; padding: 10px;">Comment</th>
                </tr>
            </thead>
            <tbody>
                @foreach($competences as $index => $competence)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;">
                        {{ $competence->label }} ({{ $competence->code }})
                        <input type="hidden" name="evaluations[{{ $index }}][competence_id]" value="{{ $competence->id }}">
                    </td>
                    <td style="padding: 10px;">
                        <select name="evaluations[{{ $index }}][level]" class="form-control" required>
                            <option value="">Select Level</option>
                            <option value="imiter">IMITER</option>
                            <option value="s_adapter">S_ADAPTER</option>
                            <option value="transposeur">TRANSPOSER</option>
                        </select>
                    </td>
                    <td style="padding: 10px;">
                        <textarea name="evaluations[{{ $index }}][comment]" class="form-control" rows="2"></textarea>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Save Evaluations</button>
    </form>
</div>
@endsection
