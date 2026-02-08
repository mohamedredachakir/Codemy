@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 space-y-10">

    @if(isset($error))
        <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-xl">
            <p class="text-rose-700 font-bold">{{ $error }}</p>
        </div>
    @else
        <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-3xl shadow-lg shadow-indigo-200 mr-6">
                    *
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-900 tracking-tight">Bonjour, {{ $user->first_name }} !</h1>
                    <p class="text-slate-500 font-medium">Classe : <span class="text-indigo-600 font-bold">{{ $user->schoolclass?->name ?? 'Non assignée' }}</span></p>
                </div>
            </div>
            <div class="bg-slate-50 px-6 py-3 rounded-2xl border border-slate-100">
                <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Projets en cours</span>
                <span class="block text-2xl font-black text-slate-800 text-center">{{ $briefs->count() }}</span>
            </div>
        </div>

        <div class="space-y-6">
            <h3 class="text-xl font-black text-slate-800 flex items-center ml-2">
                <span class="w-2 h-6 bg-indigo-600 rounded-full mr-3"></span>
                Mes Projets (Briefs)
            </h3>

            @if($briefs->isEmpty())
                <div class="bg-white rounded-[2.5rem] p-16 text-center border-2 border-dashed border-slate-200">
                    <p class="text-slate-400 font-medium italic text-lg">Aucun brief n'a été publié pour votre classe pour le moment.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($briefs as $brief)
                        <div class="bg-white rounded-[2.5rem] border border-slate-50 shadow-xl shadow-slate-200/40 overflow-hidden flex flex-col hover:-translate-y-2 transition-all duration-300 group">
                            <div class="p-8 flex-grow space-y-4">
                                <div class="flex justify-between items-start">
                                    <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-[10px] font-black uppercase tracking-widest">
                                        {{ $brief->sprint?->name ?? 'Sprint' }}
                                    </span>
                                    <span class="text-slate-300 group-hover:text-indigo-500 transition-colors">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                    </span>
                                </div>

                                <h4 class="text-xl font-black text-slate-800 leading-tight group-hover:text-indigo-600 transition-colors">
                                    {{ $brief->title }}
                                </h4>

                                <p class="text-slate-500 text-sm line-clamp-3 font-medium italic">
                                    {{ $brief->description }}
                                </p>

                                <div class="flex items-center gap-4 pt-4 text-slate-400 font-bold text-[11px] uppercase tracking-tighter">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $brief->estimated_time }} Heures
                                    </span>
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                        {{ $brief->type?->value ?? 'Individuel' }}
                                    </span>
                                </div>
                            </div>

                            <div class="p-6 bg-slate-50/50 border-t border-slate-100 mt-auto">
                                @php
                                    $studentSubmission = $brief->submissions->where('student_id', auth()->id())->first();
                                    $isEvaluated = $studentSubmission ? \App\Models\Evaluation::where('submission_id', $studentSubmission->id)->exists() : false;
                                @endphp

                                @if($studentSubmission)
                                    <div class="flex flex-col gap-3">
                                        <div class="flex items-center justify-center gap-2 text-emerald-600 font-black text-[10px] uppercase tracking-widest bg-emerald-50 py-2 rounded-xl border border-emerald-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Rendu validé
                                        </div>

                                        @if($isEvaluated)
                                            <a href="{{ route('evaluations.show', $brief->id) }}" class="w-full bg-slate-900 text-white text-center py-3 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg shadow-slate-200">
                                                Voir mes résultats
                                            </a>
                                        @else
                                            <p class="text-[10px] text-slate-400 font-bold text-center italic">En attente de correction...</p>
                                        @endif
                                    </div>
                                @else
                                    <a href="{{ route('submissions.create', ['brief_id' => $brief->id]) }}" class="w-full bg-indigo-600 text-white text-center block py-4 rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-100">
                                        Soumettre ma solution
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
