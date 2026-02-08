@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <a href="{{ route('classes.index') }}" class="text-indigo-600 font-bold flex items-center mb-2 hover:text-indigo-800 transition text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Retour aux classes
            </a>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Détails de la <span class="text-indigo-600">Classe</span></h1>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('classes.edit', $class->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-amber-100 transition flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Modifier
            </a>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
        <div class="absolute top-0 right-0 p-8 opacity-10">
            <svg class="w-32 h-32 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <div class="relative z-10">
            <span class="text-indigo-600 font-bold uppercase tracking-widest text-xs">Nom du groupe</span>
            <h2 class="text-4xl font-black text-slate-800 mt-1">{{ $class->name }}</h2>
            <div class="mt-6 flex items-center text-slate-500 font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span>Total : {{ $class->students->count() }} Étudiants</span>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <h3 class="text-xl font-bold text-slate-800 ml-2 flex items-center">
            <span class="w-2 h-6 bg-indigo-600 rounded-full mr-3"></span>
            Étudiants inscrits
        </h3>

        @if($class->students->isEmpty())
            <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] p-12 text-center text-slate-400">
                <p class="font-medium text-lg text-slate-500">Aucun étudiant n'est encore assigné à cette classe.</p>
                <p class="text-sm mt-1">Utilisez l'onglet "Utilisateurs" pour ajouter des étudiants.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($class->students as $user)
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center hover:shadow-md transition group">
                        <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 font-bold mr-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            {{ substr($user->first_name, 0, 1) }}{{ substr($user->last_name, 0, 1) }}
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-800 leading-tight">{{ $user->first_name }} {{ $user->last_name }}</h4>
                            <p class="text-xs text-slate-500">{{ $user->email }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
