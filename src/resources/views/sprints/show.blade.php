@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <a href="{{ route('sprints.index') }}" class="text-indigo-600 font-bold flex items-center mb-2 hover:text-indigo-800 transition text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                Retour aux sprints
            </a>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Détails du <span class="text-indigo-600">Sprint</span></h1>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('sprints.edit', $sprint->id) }}" class="bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-amber-100 transition flex items-center text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Modifier le Sprint
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
            <div class="relative z-10">
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-indigo-50 text-indigo-600 text-xs font-black uppercase tracking-widest mb-4">
                    Ordre : #{{ $sprint->order }}
                </span>
                <h2 class="text-4xl font-black text-slate-800 leading-tight">{{ $sprint->name }}</h2>
            </div>
            <div class="absolute -bottom-6 -right-6 opacity-5">
                <svg class="w-48 h-48 text-slate-900" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
        </div>

        <div class="bg-indigo-600 rounded-[2rem] p-8 text-white shadow-xl shadow-indigo-200 flex flex-col justify-center items-center text-center">
            <svg class="w-10 h-10 mb-3 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="text-indigo-100 text-xs font-bold uppercase tracking-widest">Durée estimée</span>
            <div class="text-5xl font-black mt-1">{{ $sprint->duration }}</div>
            <span class="text-indigo-200 font-medium">Jours</span>
        </div>
    </div>

    <div class="space-y-4">
        <h3 class="text-xl font-bold text-slate-800 ml-2 flex items-center">
            <span class="w-2 h-6 bg-emerald-500 rounded-full mr-3"></span>
            Classes utilisant ce Sprint
        </h3>

        @if($sprint->classes->isEmpty())
            <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-[2rem] p-12 text-center">
                <p class="text-slate-400 font-medium">Aucune classe n'est actuellement assignée à ce sprint.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($sprint->classes as $class)
                    <div class="bg-white p-5 rounded-2xl border border-slate-100 shadow-sm flex items-center group hover:shadow-md transition">
                        <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400 mr-4 group-hover:bg-emerald-50 group-hover:text-emerald-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <span class="font-bold text-slate-700 tracking-tight">{{ $class->name }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
