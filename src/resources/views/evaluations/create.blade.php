@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 space-y-8">

    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center">
            <div class="w-16 h-16 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-indigo-200 mr-5">
                {{ substr($submission->student?->first_name, 0, 1) }}
            </div>
            <div>
                <h1 class="text-2xl font-black text-slate-900 tracking-tight">Évaluation de {{ $submission->student?->first_name }} {{ $submission->student?->last_name }}</h1>
                <p class="text-slate-500 font-bold uppercase text-xs tracking-widest mt-1">
                    Projet : <span class="text-indigo-600">{{ $submission->brief?->title }}</span>
                </p>
            </div>
        </div>
        <a href="{{ url('/dashboard') }}" class="px-5 py-2 bg-slate-100 text-slate-500 rounded-xl font-bold text-sm hover:bg-slate-200 transition">
            Annuler
        </a>
    </div>

    <div class="space-y-4">
        <h3 class="text-sm font-black text-slate-400 uppercase tracking-widest ml-4">Livrable soumis</h3>
        <div class="bg-slate-900 text-slate-300 p-8 rounded-[2rem] shadow-inner font-mono text-sm leading-relaxed border-t-4 border-indigo-500">
            {{ $submission->content }}
        </div>
    </div>

    <form method="POST" action="{{ route('evaluations.store') }}" class="space-y-6">
        @csrf
        <input type="hidden" name="submission_id" value="{{ $submission->id }}">

        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Compétence</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">Niveau d'acquisition</th>
                        <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Commentaire</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($competences as $index => $competence)
                    <tr class="hover:bg-slate-50/30 transition-colors">
                        <td class="px-8 py-6">
                            <p class="font-bold text-slate-800">{{ $competence->label }}</p>
                            <span class="text-[10px] font-black text-indigo-400 uppercase tracking-tighter">{{ $competence->code }}</span>
                            <input type="hidden" name="evaluations[{{ $index }}][competence_id]" value="{{ $competence->id }}">
                        </td>
                        <td class="px-8 py-6">
                            <select name="evaluations[{{ $index }}][level]" required
                                class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 font-bold text-sm text-slate-700 focus:ring-4 focus:ring-indigo-500/10 outline-none appearance-none">
                                <option value="">Choisir...</option>
                                <option value="imiter" class="text-rose-500"> IMITER</option>
                                <option value="s_adapter" class="text-amber-500"> S'ADAPTER</option>
                                <option value="transposeur" class="text-emerald-500"> TRANSPOSER</option>
                            </select>
                        </td>
                        <td class="px-8 py-6">
                            <textarea name="evaluations[{{ $index }}][comment]" rows="1"
                                class="w-full bg-slate-50 border border-transparent rounded-xl px-4 py-2.5 text-sm focus:bg-white focus:border-indigo-500 outline-none transition-all"
                                placeholder="Note facultative..."></textarea>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="group bg-indigo-600 text-white px-12 py-4 rounded-2xl font-black shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-1 transition-all active:scale-95 flex items-center">
                Enregistrer l'évaluation
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
            </button>
        </div>
    </form>
</div>
@endsection
