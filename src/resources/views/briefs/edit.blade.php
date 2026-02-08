@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">

    <div class="mb-8">
        <a href="{{ url('/briefs') }}" class="text-indigo-600 font-bold flex items-center mb-2 hover:text-indigo-800 transition text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Retour à la liste
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Modifier le <span class="text-indigo-600">Brief</span></h1>
        <p class="text-slate-500 font-medium italic">Mise à jour du projet : <strong>{{ $brief->title }}</strong></p>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <form action="{{ route('briefs.update', $brief->id) }}" method="POST" class="p-8 md:p-12 space-y-8">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Titre du Projet</label>
                <input type="text" name="title" value="{{ old('title', $brief->title) }}" required
                    class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all font-bold text-lg">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Classe concernée</label>
                    <select name="class_id" required class="w-full px-6 py-4 rounded-2xl border border-slate-200 bg-slate-50 font-bold text-slate-700 outline-none focus:ring-4 focus:ring-indigo-500/10 appearance-none">
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" @selected(old('class_id', $brief->class_id) == $class->id)>
                                {{ $class->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Type de Travail</label>
                    <select name="type" required class="w-full px-6 py-4 rounded-2xl border border-slate-200 bg-slate-50 font-bold text-slate-700 outline-none focus:ring-4 focus:ring-indigo-500/10 appearance-none">
                        {{-- استخدمنا القيم النصية مباشرة لتفادي مشاكل الـ Enum في العرض --}}
                        <option value="individual" @selected(old('type', $brief->type) == 'individual')>👤 Individuel</option>
                        <option value="group" @selected(old('type', $brief->type) == 'group')>👥 En Groupe</option>
                    </select>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Description</label>
                <textarea name="description" required rows="5"
                    class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">{{ old('description', $brief->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Temps Estimé (Jours)</label>
                    <input type="number" name="estimated_time" value="{{ old('estimated_time', $brief->estimated_time) }}" required
                        class="w-full px-6 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all font-bold">
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">Sprint associé</label>
                    <select name="sprint_id" required class="w-full px-6 py-4 rounded-2xl border border-slate-200 bg-slate-50 font-bold text-slate-700 outline-none focus:ring-4 focus:ring-indigo-500/10">
                        @foreach($sprints as $sprint)
                            <option value="{{ $sprint->id }}" @selected(old('sprint_id', $brief->sprint_id) == $sprint->id)>
                                Sprint {{ $sprint->order }} : {{ $sprint->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
                <label class="relative inline-flex items-center cursor-pointer group">
                    <input type="checkbox" name="is_published" value="1" class="sr-only peer" {{ $brief->is_published ? 'checked' : '' }}>
                    <div class="w-14 h-7 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-indigo-600"></div>
                    <span class="ml-3 text-sm font-bold text-slate-600 group-hover:text-indigo-600 transition-colors">Publier le brief</span>
                </label>

                <button type="submit" class="w-full md:w-auto px-10 py-4 bg-indigo-600 text-white rounded-2xl font-black shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all uppercase text-xs tracking-widest">
                    Mettre à jour le Brief
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
