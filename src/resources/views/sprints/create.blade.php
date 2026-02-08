@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('sprints.index') }}" class="text-indigo-600 font-bold flex items-center mb-2 hover:text-indigo-800 transition text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Retour aux sprints
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Créer un <span class="text-indigo-600">Nouveau Sprint</span></h1>
        <p class="text-slate-500 font-medium">Définissez les objectifs temporels et les compétences liées.</p>
    </div>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
        <form action="{{ route('sprints.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-3">
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nom du Sprint</label>
                    <input type="text" name="name" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="Ex: Sprint 1 - Fondamentaux">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Durée (Jours)</label>
                    <input type="number" name="duration" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                        placeholder="7">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Ordre de passage</label>
                    <input type="number" name="order" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all"
                        placeholder="1">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100">
                <label class="block text-sm font-bold text-slate-700 mb-4 ml-1 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    Sélectionner les Compétences
                </label>

                <div class="relative group">
                    <select name="competences[]" multiple
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all min-h-[200px] bg-slate-50/50 cursor-pointer">
                        @foreach($competences as $competence)
                            <option value="{{ $competence->id }}" class="py-2 px-2 rounded-lg hover:bg-indigo-100 checked:bg-indigo-600 checked:text-white transition-all font-medium mb-1">
                                {{ $competence->label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <p class="mt-3 text-xs text-slate-400 font-medium">
                    <span class="text-indigo-600 font-bold">Astuce :</span> Maintenez <kbd class="px-2 py-1 bg-slate-100 rounded text-slate-600 border border-slate-200 shadow-sm">Ctrl</kbd> ou <kbd class="px-2 py-1 bg-slate-100 rounded text-slate-600 border border-slate-200 shadow-sm">Cmd</kbd> pour sélectionner plusieurs compétences.
                </p>
            </div>

            <div class="pt-6">
                <button type="submit"
                    class="w-full md:w-auto px-12 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-indigo-600 transition-all duration-300 shadow-lg shadow-indigo-100 flex items-center justify-center transform active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Créer le Sprint
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
