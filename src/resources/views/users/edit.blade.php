@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('users.index') }}" class="text-indigo-600 font-bold flex items-center mb-2 hover:text-indigo-800 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Retour à la liste
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Modifier <span class="text-indigo-600">l'Utilisateur</span></h1>
        <p class="text-slate-500 font-medium">Mise à jour des informations de {{ $user->first_name }} {{ $user->last_name }}.</p>
    </div>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
        <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Prénom</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nom</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Adresse Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100">
                <div class="mb-4 bg-amber-50 border-l-4 border-amber-400 p-4 rounded-r-xl">
                    <p class="text-sm text-amber-700 font-medium">
                        Laissez les champs du mot de passe <strong>vides</strong> si vous ne souhaitez pas les modifier.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nouveau mot de passe</label>
                        <input type="password" name="password"
                            class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Confirmer le mot de passe</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100">
                <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Rôle de l'utilisateur</label>
                <select name="role" required
                    class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all appearance-none bg-white">
                    <option value="{{ \App\Enums\UserRole::STUDENT }}" {{ $user->role == \App\Enums\UserRole::STUDENT ? 'selected' : '' }}>Étudiant (Student)</option>
                    <option value="{{ \App\Enums\UserRole::TEACHER }}" {{ $user->role == \App\Enums\UserRole::TEACHER ? 'selected' : '' }}>Formateur (Teacher)</option>
                    <option value="{{ \App\Enums\UserRole::ADMIN }}" {{ $user->role == \App\Enums\UserRole::ADMIN ? 'selected' : '' }}>Administrateur (Admin)</option>
                </select>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full md:w-auto px-10 py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 transition-all duration-300 shadow-lg shadow-indigo-100 flex items-center justify-center transform active:scale-95">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Mettre à jour l'utilisateur
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
