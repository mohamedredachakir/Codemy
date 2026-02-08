@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Tableau de bord <span class="text-indigo-600">Formateur</span></h1>
            <p class="text-slate-500 font-medium italic">Suivi des livrables و évaluations en temps réel.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('briefs.index') }}" class="px-6 py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition-all shadow-lg shadow-slate-200 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                Gérer les Briefs
            </a>
        </div>
    </div>

    @foreach($classes as $class)
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-50 overflow-hidden">
            <div class="bg-slate-50/50 px-8 py-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-indigo-200 mr-4">
                        {{ substr($class->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight">{{ $class->name }}</h2>
                        <span class="text-sm font-bold text-slate-400">{{ $class->students()->count() }} Étudiants inscrits</span>
                    </div>
                </div>
                <a href="{{ route('briefs.create') }}?class_id={{ $class->id }}" class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2.5 rounded-xl font-bold transition-all flex items-center text-sm shadow-md shadow-emerald-100">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Nouveau Brief
                </a>
            </div>

            @php
                $submissions = \App\Models\Submission::whereHas('brief', function($q) use ($class) {
                    $q->where('class_id', $class->id);
                })->with(['student', 'brief.sprint', 'evaluations'])->get();

                $pending = $submissions->filter(fn($s) => $s->evaluations->count() === 0);
                $graded = $submissions->filter(fn($s) => $s->evaluations->count() > 0);

                $students = $class->students;
                $studentIdsWithSubmission = $submissions->pluck('student_id')->unique()->toArray();
                $noSubmission = $students->filter(fn($stu) => !in_array($stu->id, $studentIdsWithSubmission));
            @endphp

            <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="space-y-4">
                    <h4 class="text-sm font-black text-rose-500 uppercase tracking-widest flex items-center ml-2">
                        <span class="w-2 h-2 bg-rose-500 rounded-full mr-2 animate-pulse"></span>
                        En attente ({{ $pending->count() }})
                    </h4>
                    <div class="space-y-3">
                        @forelse($pending as $sub)
                            <div class="bg-white p-4 rounded-2xl border border-rose-100 shadow-sm flex justify-between items-center group hover:bg-rose-50/30 transition-all">
                                <div class="overflow-hidden">
                                    <p class="font-bold text-slate-800 text-sm truncate">{{ $sub->student->first_name }} {{ $sub->student->last_name }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $sub->brief->title }}</p>
                                </div>
                                <a href="{{ route('evaluations.create', ['submission_id' => $sub->id]) }}" class="bg-rose-100 text-rose-600 px-3 py-1.5 rounded-lg font-black text-[10px] hover:bg-rose-600 hover:text-white transition-all uppercase">
                                    Évaluer
                                </a>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic text-center py-4 bg-slate-50 rounded-xl border border-dashed">Aucun travail en attente.</p>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-4">
                    <h4 class="text-sm font-black text-emerald-500 uppercase tracking-widest flex items-center ml-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></span>
                        Évalués ({{ $graded->count() }})
                    </h4>
                    <div class="space-y-3">
                        @forelse($graded as $sub)
                            <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex justify-between items-center hover:border-emerald-200 transition-all">
                                <div class="overflow-hidden">
                                    <p class="font-bold text-slate-800 text-sm truncate">{{ $sub->student->first_name }} {{ $sub->student->last_name }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $sub->brief->title }}</p>
                                </div>
                                <a href="{{ route('evaluations.show', $sub->brief_id) }}?student_id={{ $sub->student_id }}" class="text-slate-400 hover:text-indigo-600 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </a>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic text-center py-4 bg-slate-50 rounded-xl border border-dashed">Aucune évaluation terminée.</p>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-4">
                    <h4 class="text-sm font-black text-slate-400 uppercase tracking-widest flex items-center ml-2">
                        <span class="w-2 h-2 bg-slate-300 rounded-full mr-2"></span>
                        Non-rendus ({{ $noSubmission->count() }})
                    </h4>
                    <div class="space-y-3">
                        @forelse($noSubmission as $stu)
                            <div class="bg-slate-50/50 p-4 rounded-2xl border border-slate-100 flex items-center group opacity-70">
                                <div class="w-8 h-8 bg-slate-200 rounded-lg flex items-center justify-center text-slate-500 font-bold text-xs mr-3 group-hover:bg-slate-300 transition-colors">
                                    {{ substr($stu->first_name, 0, 1) }}
                                </div>
                                <p class="font-bold text-slate-500 text-xs">{{ $stu->first_name }} {{ $stu->last_name }}</p>
                            </div>
                        @empty
                            <p class="text-xs text-emerald-500 font-bold text-center py-4 bg-emerald-50 rounded-xl border border-dashed border-emerald-100 italic">Tous les étudiants ont rendu !</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    @endforeach
</div>
@endsection
