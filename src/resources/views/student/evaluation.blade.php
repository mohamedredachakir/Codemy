<h2>Evaluation</h2>

@foreach($evaluations as $evaluation)

<div style="border:1px solid #ccc; margin:10px; padding:10px">

    <h4>{{ $evaluation->competence->label }}</h4>

    <p>Level: {{ $evaluation->level }}</p>

    <p>{{ $evaluation->comment }}</p>

</div>

@endforeach
