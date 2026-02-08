@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 space-y-8">

    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col md:flex-row justify-between items-end gap-6">
        <div>
            <div class="flex items-center gap-3 mb-3">
                <span class="px-3 py-1 rounded-lg bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                    Suivi du Brief
                </span>
                <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-widest border border-slate-200">
                    {{ $brief->schoolclass->name }}
                </span>
            </div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $brief->title }}</h1>
            <p class="text-slate-500 font-medium mt-1">Sprint : <span class="text-slate-800 font-bold">{{ $brief->sprint?->name ?? 'N/A' }}</span></p>
        </div>
        <div class="flex gap-3">
             <a href="{{ route('briefs.index') }}" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-slate-200 transition-all">
                Retour
            </a>
            <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-slate-900 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg shadow-slate-200">
                Dashboard
            </a>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Étudiant</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Statut</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Rendu le</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($students as $student)
                @php
                    $submission = $submissions->get($student->id);
                    $isEvaluated = $submission ? \App\Models\Evaluation::where('submission_id', $submission->id)->exists() : false;
                @endphp
                <tr class="hover:bg-slate-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500 font-black text-sm mr-4 border border-slate-200">
                                {{ substr($student->first_name, 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="font-bold text-slate-800 text-sm">{{ $student->first_name }} {{ $student->last_name }}</span>
                                <span class="text-[10px] text-slate-400 font-medium italic">{{ $student->email }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @if(!$submission)
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-slate-50 text-slate-400 border border-slate-100 text-[10px] font-black uppercase tracking-widest">
                                Pas de rendu
                            </span>
                        @elseif(!$isEvaluated)
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-rose-50 text-rose-600 border border-rose-100 text-[10px] font-black uppercase tracking-widest animate-pulse">
                                En attente
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 text-[10px] font-black uppercase tracking-widest">
                                Évalué ✔
                            </span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-slate-500 text-sm">
                        {{ $submission ? $submission->submitted_at->format('d/m/Y H:i') : '-' }}
                    </td>
                    <td class="px-8 py-6 text-right">
                        @if($submission && !$isEvaluated)
                            <a href="{{ route('evaluations.create', ['submission_id' => $submission->id]) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-black text-[10px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-md shadow-indigo-100">
                                Évaluer
                            </a>
                        @elseif($isEvaluated)
                            <a href="{{ route('evaluations.show', $brief->id) }}?student_id={{ $student->id }}" class="text-indigo-600 hover:text-indigo-800 font-black text-[10px] uppercase tracking-widest">
                                Détails
                            </a>
                        @else
                           <span class="text-slate-300 font-black text-[10px] uppercase tracking-widest">N/A</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
