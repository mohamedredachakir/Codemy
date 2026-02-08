@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('users.index') }}" class="text-indigo-600 font-bold flex items-center mb-2 hover:text-indigo-800 transition">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Retour à la liste
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Créer un <span class="text-indigo-600">Nouvel Utilisateur</span></h1>
        <p class="text-slate-500 font-medium">Remplissez les informations pour ajouter un membre à Codemy.</p>
    </div>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-12">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Prénom</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="Ex: Ahmed">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Nom</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="Ex: Bennani">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Adresse Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                        placeholder="nom@ecole.com">
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Mot de passe</label>
                    <input type="password" name="password" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400">
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2 ml-1">Rôle de l'utilisateur</label>
                    <select name="role" required
                        class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all appearance-none bg-no-repeat bg-[right_1.5rem_center] bg-[length:1.5em_1.5em]">
                        <option value="{{ \App\Enums\UserRole::STUDENT }}" {{ old('role') == \App\Enums\UserRole::STUDENT ? 'selected' : '' }}>Étudiant (Student)</option>
                        <option value="{{ \App\Enums\UserRole::TEACHER }}" {{ old('role') == \App\Enums\UserRole::TEACHER ? 'selected' : '' }}>Formateur (Teacher)</option>
                        <option value="{{ \App\Enums\UserRole::ADMIN }}" {{ old('role') == \App\Enums\UserRole::ADMIN ? 'selected' : '' }}>Administrateur (Admin)</option>
                    </select>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                    class="w-full md:w-auto px-10 py-4 bg-slate-900 text-white rounded-2xl font-bold hover:bg-indigo-600 transition-all duration-300 shadow-lg shadow-indigo-100 flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                    Enregistrer l'utilisateur
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
