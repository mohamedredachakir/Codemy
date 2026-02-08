@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 space-y-8">
    
    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col md:flex-row items-center gap-6">
        <div class="w-24 h-24 bg-indigo-600 rounded-3xl flex items-center justify-center text-white text-4xl font-black shadow-lg shadow-indigo-200">
            {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
        </div>
        <div class="flex-grow text-center md:text-left">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $user->first_name }} {{ $user->last_name }}</h1>
            <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-2">
                <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-slate-200">
                    {{ $user->role }}
                </span>
                <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                    {{ $user->schoolclass?->name ?? 'Aucune classe' }}
                </span>
            </div>
            <p class="text-slate-400 text-sm mt-2 font-medium">{{ $user->email }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ url('/users') }}" class="px-6 py-3 bg-slate-100 text-slate-600 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-slate-200 transition">Retour</a>
            <a href="{{ route('users.edit', $user->id) }}" class="px-6 py-3 bg-indigo-600 text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-indigo-700 transition shadow-lg shadow-indigo-100">Modifier</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100">
            <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Dernières Soumissions
            </h3>
            @forelse($user->submissions as $submission)
                <div class="mb-4 p-4 rounded-2xl bg-slate-50 border border-slate-100 flex justify-between items-center">
                    <div>
                        <p class="font-bold text-slate-800 text-sm">{{ $submission->brief?->title ?? 'Brief inconnu' }}</p>
                        <p class="text-[10px] text-slate-400 font-bold uppercase">{{ optional($submission->submitted_at)->format('d M Y H:i') }}</p>
                    </div>
                    @if(method_exists($submission, 'isLate') && $submission->isLate())
                        <span class="px-2 py-1 bg-rose-100 text-rose-600 rounded-md text-[9px] font-black uppercase">En retard</span>
                    @endif
                </div>
            @empty
                <p class="text-slate-400 italic text-sm text-center py-4">Aucune soumission trouvée.</p>
            @endforelse
        </div>

        <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100">
            <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                Évaluations Reçues
            </h3>
            @forelse($user->evaluationsReceived as $evaluation)
                <div class="mb-4 p-4 rounded-2xl border border-slate-100 space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-slate-800 text-xs">{{ $evaluation->competence?->label ?? 'Compétence' }}</span>
                        <span class="text-[10px] font-black px-2 py-0.5 bg-indigo-600 text-white rounded-md uppercase">
                            {{ is_object($evaluation->level) ? $evaluation->level->value : $evaluation->level }}
                        </span>
                    </div>
                    <p class="text-xs text-slate-500 italic">"{{ $evaluation->comment ?? 'Sans commentaire' }}"</p>
                </div>
            @empty
                <p class="text-slate-400 italic text-sm text-center py-4">Aucune évaluation reçue.</p>
            @endforelse
        </div>
    </div>

</div>
@endsection