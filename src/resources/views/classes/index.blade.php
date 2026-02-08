@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
        <div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Liste des <span class="text-indigo-600">Classes</span></h1>
            <p class="text-slate-500 text-sm font-medium">Organisez vos groupes d'étudiants et leurs parcours.</p>
        </div>
        <a href="{{ route('classes.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 group">
            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Ajouter une classe
        </a>
    </div>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-8 py-5 text-xs font-bold text-slate-500 uppercase tracking-widest">ID</th>
                    <th class="px-8 py-5 text-xs font-bold text-slate-500 uppercase tracking-widest">Nom de la Classe</th>
                    <th class="px-8 py-5 text-xs font-bold text-slate-500 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($classes as $class)
                <tr class="hover:bg-indigo-50/20 transition-colors group">
                    <td class="px-8 py-5 text-sm font-mono text-slate-400">#{{ $class->id }}</td>
                    <td class="px-8 py-5">
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full bg-indigo-400 mr-3 group-hover:scale-150 transition-transform"></div>
                            <span class="text-sm font-bold text-slate-700 tracking-tight">{{ $class->name }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-right space-x-3">
                        <a href="{{ route('classes.show', $class->id) }}" class="inline-flex text-blue-600 hover:text-blue-800 font-bold text-sm transition underline-offset-4 hover:underline">
                            Voir
                        </a>

                        <a href="{{ route('classes.edit', $class->id) }}" class="inline-flex text-amber-600 hover:text-amber-800 font-bold text-sm transition underline-offset-4 hover:underline">
                            Modifier
                        </a>

                        <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm transition underline-offset-4 hover:underline"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?');">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($classes->isEmpty())
        <div class="p-20 text-center">
            <div class="inline-flex p-4 rounded-full bg-slate-50 mb-4">
                <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <p class="text-slate-400 font-medium">Aucune classe n'a été créée pour le moment.</p>
        </div>
        @endif
    </div>
</div>
@endsection
