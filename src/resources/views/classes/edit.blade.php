@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('classes.index') }}" class="text-indigo-600 font-bold flex items-center mb-2 hover:text-indigo-800 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Retour à la liste
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Modifier la <span class="text-indigo-600">Classe</span></h1>
        <p class="text-slate-500 font-medium">Vous modifiez actuellement les informations de la classe : <span class="text-slate-800 font-bold">{{ $class->name }}</span></p>
    </div>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-10">
        <form action="{{ route('classes.update', $class->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nom de la classe</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <input type="text" name="name" id="name" value="{{ old('name', $class->name) }}" required
                        class="w-full pl-11 pr-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400">
                </div>
                @error('name')
                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 flex flex-col md:flex-row gap-4">
                <button type="submit"
                    class="flex-1 bg-indigo-600 text-white py-4 rounded-2xl font-bold hover:bg-indigo-700 transition-all duration-300 shadow-lg shadow-indigo-100 flex items-center justify-center transform active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Mettre à jour la classe
                </button>

                <a href="{{ route('classes.index') }}"
                    class="flex-1 bg-slate-100 text-slate-600 py-4 rounded-2xl font-bold hover:bg-slate-200 transition-all text-center">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
