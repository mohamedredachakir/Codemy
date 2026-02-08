@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Gestion des <span class="text-indigo-600">Sprints</span></h1>
            <p class="text-slate-500 text-sm font-medium">Planifiez les cycles de travail et l'ordre des étapes pédagogiques.</p>
        </div>
        <a href="{{ route('sprints.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 group">
            <svg class="w-5 h-5 mr-2 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            Nouveau Sprint
        </a>
    </div>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Ordre</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Sprint</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Durée</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($sprints as $sprint)
                <tr class="hover:bg-slate-50/80 transition-colors">
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50 text-indigo-700 font-black text-sm border border-indigo-100">
                            {{ $sprint->order }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-slate-800">{{ $sprint->name }}</div>
                        <div class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter italic">ID: #{{ $sprint->id }}</div>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold border border-emerald-100">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $sprint->duration }} Jours
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('sprints.show', $sprint->id) }}" class="text-indigo-600 hover:text-indigo-800 font-bold text-xs uppercase tracking-widest transition">Détails</a>
                        <a href="{{ route('sprints.edit', $sprint->id) }}" class="text-amber-600 hover:text-amber-800 font-bold text-xs uppercase tracking-widest transition">Éditer</a>

                        <form action="{{ route('sprints.destroy', $sprint->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-xs uppercase tracking-widest transition" onclick="return confirm('Confirmer la suppression ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($sprints->isEmpty())
        <div class="p-12 text-center">
            <p class="text-slate-400 font-medium italic">Aucun sprint n'a été planifié pour le moment.</p>
        </div>
        @endif
    </div>
</div>
@endsection
