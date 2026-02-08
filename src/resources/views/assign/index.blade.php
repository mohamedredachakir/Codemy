@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-10">

    <div class="flex flex-col md:flex-row justify-between items-end gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Tableau d' <span class="text-indigo-600">Affectation</span></h1>
            <p class="text-slate-500 font-medium">Gérez les attributions et surveillez les ressources non-assignées.</p>
        </div>
        <div class="flex gap-4">
            <div class="bg-amber-50 border border-amber-100 px-4 py-2 rounded-2xl">
                <span class="block text-[10px] font-bold text-amber-500 uppercase">Étudiants sans classe</span>
                <span class="text-xl font-black text-amber-700">{{ $students->where('class_id', null)->count() }}</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

        <div class="space-y-6">
            <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8">
                <h2 class="text-xl font-black text-slate-800 mb-6 flex items-center">
                    <span class="w-2 h-6 bg-indigo-600 rounded-full mr-3"></span>
                    Assigner un Formateur
                </h2>
                <form action="{{ route('assign.teacher') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <select name="class_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 font-bold text-sm">
                            <option value="" disabled selected>Choisir la Classe</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        <select name="teacher_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 font-bold text-sm">
                            <option value="" disabled selected>Choisir le Formateur</option>
                            @foreach($teachers as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-slate-900 text-white py-3 rounded-xl font-bold hover:bg-indigo-600 transition-all text-sm uppercase tracking-widest">
                        Lier le formateur
                    </button>
                </form>
            </div>

            <div class="bg-slate-50 rounded-[2rem] p-6 border border-slate-100">
                <h3 class="text-sm font-bold text-slate-500 mb-4 uppercase ml-2">Assignations Actuelles</h3>
                <div class="space-y-4">
                    @foreach($classes->filter(fn($c) => $c->teachers->count() > 0) as $c)
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100">
                        <span class="block font-black text-slate-800 text-xs uppercase tracking-widest mb-2">{{ $c->name }}</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($c->teachers as $teacher)
                                <span class="text-[10px] bg-indigo-50 text-indigo-600 px-3 py-1 rounded-lg font-bold border border-indigo-100">
                                    {{ $teacher->first_name }} {{ $teacher->last_name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8">
                <h2 class="text-xl font-black text-slate-800 mb-6 flex items-center">
                    <span class="w-2 h-6 bg-emerald-500 rounded-full mr-3"></span>
                    Assigner un Étudiant
                </h2>
                <form action="{{ route('assign.student') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <select name="class_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 font-bold text-sm">
                            <option value="" disabled selected>Classe Cible</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        <select name="student_id" required class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 font-bold text-sm">
                            <option value="" disabled selected>Étudiant Libre</option>
                            @foreach($students->where('class_id', null) as $student)
                                <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-emerald-600 text-white py-3 rounded-xl font-bold hover:bg-emerald-700 transition-all text-sm uppercase tracking-widest">
                        Inscrire l'étudiant
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm">
                <h3 class="text-sm font-bold text-slate-500 mb-4 uppercase ml-2">Étudiants en attente (Libres)</h3>
                <div class="max-h-[200px] overflow-y-auto pr-2 space-y-2 custom-scrollbar">
                    @forelse($students->where('class_id', null) as $st)
                        <div class="flex items-center justify-between p-2 hover:bg-slate-50 rounded-lg transition">
                            <span class="text-sm text-slate-600 font-medium">{{ $st->first_name }} {{ $st->last_name }}</span>
                            <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic text-center py-4">Tous les étudiants sont assignés.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
</style>
@endsection
