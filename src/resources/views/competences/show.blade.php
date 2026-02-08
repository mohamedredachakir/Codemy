@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <a href="{{ route('competences.index') }}" class="text-indigo-600 font-bold flex items-center mb-2 hover:text-indigo-800 transition text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Retour au référentiel
            </a>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Détails de la <span class="text-indigo-600">Compétence</span></h1>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('competences.edit', $competence->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-amber-100 transition flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Modifier
            </a>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
        <div class="flex flex-col md:flex-row md:items-center gap-8 relative z-10">
            <div class="flex-shrink-0 w-24 h-24 bg-slate-900 text-white rounded-[1.5rem] flex items-center justify-center text-2xl font-black shadow-2xl">
                {{ $competence->code }}
            </div>
            <div>
                <span class="text-indigo-600 font-bold uppercase tracking-widest text-xs italic">Libellé de la compétence</span>
                <h2 class="text-3xl font-black text-slate-800 mt-1 leading-tight">{{ $competence->label }}</h2>
                <p class="text-slate-400 text-sm mt-2 font-mono">ID unique: #{{ $competence->id }}</p>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <h3 class="text-xl font-bold text-slate-800 ml-2 flex items-center">
            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            Sprints associés à cette compétence
        </h3>

        @if($competence->sprints->isEmpty())
            <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] p-12 text-center">
                <p class="text-slate-400 font-medium italic">Aucun sprint n'est actuellement lié à cette compétence.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4">
                @foreach($competence->sprints as $sprint)
                    <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between group hover:border-indigo-200 transition-all">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-sm border border-indigo-100">
                                {{ $sprint->order }}
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">{{ $sprint->name }}</h4>
                                <span class="text-xs text-slate-400 font-medium">Cycle d'apprentissage</span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0 flex items-center bg-emerald-50 px-4 py-2 rounded-xl border border-emerald-100">
                            <svg class="w-4 h-4 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="text-emerald-700 font-bold text-sm">{{ $sprint->duration }} Jours</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
