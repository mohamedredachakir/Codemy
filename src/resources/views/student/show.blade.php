<h2>{{ $brief->title }}</h2>

<p>{{ $brief->description }}</p>

<h4>Competences</h4>

<ul>
@foreach($brief->sprint->competences as $competence)
    <li>{{ $competence->label }}</li>
@endforeach
</ul>

@if(!$submission)

<a href="{{ route('student.submissions.create',$brief->id) }}">
    Submit
</a>

@else

<p>Submission done ✔</p>

<a href="{{ route('student.evaluations.show',$submission->id) }}">
    View Evaluation
</a>

@endif
