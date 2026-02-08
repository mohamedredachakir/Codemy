@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-black text-slate-800">Créer un Brief pour : <span class="text-indigo-600">{{ $class->name }}</span></h1>
    </div>

    <div class="bg-white p-8 rounded-[2rem] shadow-lg border border-slate-100">
        <form action="{{ route('briefs.store') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden" name="class_id" value="{{ $class->id }}">
            <input type="hidden" name="teacher_id" value="{{ auth()->id() }}">

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Titre</label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none transition-all">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                <textarea name="description" required rows="4"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none transition-all">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Temps estimé (heures)</label>
                    <input type="number" name="estimated_time" value="{{ old('estimated_time') }}" required
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 outline-none transition-all">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Type</label>
                    <select name="type" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white outline-none">
                        {{-- استخدمنا القيمة النصية مباشرة لتجنب أخطاء الـ Enum في الـ View --}}
                        <option value="individual">Individuel</option>
                        <option value="group">Groupe</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Sprint</label>
                <select name="sprint_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white outline-none">
                    @isset($sprints)
                        @foreach($sprints as $sprint)
                            <option value="{{ $sprint->id }}">{{ $sprint->name }} ({{ $sprint->duration }} jours)</option>
                        @endforeach
                    @else
                        <option disabled>Aucun sprint disponible</option>
                    @endisset
                </select>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_published" value="1" id="publish" class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="publish" class="ml-2 text-sm font-medium text-slate-600">Publier immédiatement</label>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold hover:bg-indigo-700 transition-all shadow-md">
                    Créer le Brief
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
