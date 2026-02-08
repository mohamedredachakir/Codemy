@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-8 bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">Liste des Utilisateurs</h1>
        <p class="text-slate-500 text-sm">Gérer les comptes du système</p>
    </div>
    <a href="{{ route('users.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-indigo-100 transition">
        + Créer un utilisateur
    </a>
</div>

<div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 border-b border-slate-100">
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">ID</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Nom & Prénom</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Email</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Rôle</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Classe</th>
                <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($users as $user)
            <tr class="hover:bg-slate-50 transition">
                <td class="px-6 py-4 text-sm text-slate-400 font-mono">#{{ $user->id }}</td>
                <td class="px-6 py-4 text-sm font-bold text-slate-700">
                    {{ $user->first_name }} {{ $user->last_name }}
                </td>
                <td class="px-6 py-4 text-sm text-slate-600">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-4">
                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase bg-indigo-50 text-indigo-700 border border-indigo-100">
                        {{ $user->role }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-slate-600">
                    {{ $user->schoolclass->name ?? 'Aucune' }}
                </td>
                <td class="px-6 py-4 space-x-2">
                    <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:underline font-bold text-sm">Voir</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="text-amber-600 hover:underline font-bold text-sm">Modifier</a>

                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline font-bold text-sm" onclick="return confirm('Êtes-vous sûr ?')">
                            Supprimer
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
