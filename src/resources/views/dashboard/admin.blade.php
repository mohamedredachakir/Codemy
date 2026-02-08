@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Tableau de bord <span class="text-indigo-600">Admin</span></h1>
            <p class="text-slate-500 font-medium">Gérez votre plateforme, vos utilisateurs et vos ressources pédagogiques.</p>
        </div>
        <div class="flex items-center space-x-2 text-sm font-bold bg-indigo-50 text-indigo-700 px-4 py-2 rounded-xl border border-indigo-100">
            <span class="relative flex h-3 w-3 mr-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-indigo-500"></span>
            </span>
            Système en ligne
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <a href="{{ route('users.index') }}" class="group bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 hover:shadow-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
            <div class="bg-blue-50 w-14 h-14 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Utilisateurs</h3>
            <p class="text-slate-500 text-sm font-medium">Gérer les comptes des étudiants et des formateurs.</p>
            <div class="mt-6 flex items-center text-blue-600 font-bold text-sm">
                Gérer maintenant <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </a>

        <a href="{{ route('classes.index') }}" class="group bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 hover:shadow-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
            <div class="bg-indigo-50 w-14 h-14 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Classes</h3>
            <p class="text-slate-500 text-sm font-medium">Organiser les groupes et assigner les classes.</p>
            <div class="mt-6 flex items-center text-indigo-600 font-bold text-sm">
                Gérer maintenant <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </a>

        <a href="{{ route('sprints.index') }}" class="group bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 hover:shadow-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
            <div class="bg-emerald-50 w-14 h-14 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Sprints</h3>
            <p class="text-slate-500 text-sm font-medium">Planifier les cycles de travail et les durées.</p>
            <div class="mt-6 flex items-center text-emerald-600 font-bold text-sm">
                Gérer maintenant <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </a>

        <a href="{{ route('competences.index') }}" class="group bg-white p-8 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/40 hover:shadow-indigo-100 transition-all duration-300 transform hover:-translate-y-1">
            <div class="bg-amber-50 w-14 h-14 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Compétences</h3>
            <p class="text-slate-500 text-sm font-medium">Définir les critères d'évaluation et les labels.</p>
            <div class="mt-6 flex items-center text-amber-600 font-bold text-sm">
                Gérer maintenant <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </div>
        </a>

        <a href="{{ route('assign.index') }}" class="group bg-slate-900 p-8 rounded-[2rem] shadow-xl shadow-slate-300 transition-all duration-300 transform hover:-translate-y-1 lg:col-span-2 flex flex-col md:flex-row md:items-center justify-between">
            <div>
                <div class="bg-white/10 w-14 h-14 rounded-2xl flex items-center justify-center mb-6 md:mb-0 md:mr-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
                <div class="md:mt-4">
                    <h3 class="text-xl font-bold text-white mb-2">Assignation Globale</h3>
                    <p class="text-slate-400 text-sm font-medium">Lier les formateurs aux classes et les sprints aux compétences.</p>
                </div>
            </div>
            <div class="mt-6 md:mt-0 bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-indigo-500 transition">
                Accéder à l'assignation
            </div>
        </a>

    </div>
</div>
@endsection
