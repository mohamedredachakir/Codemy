@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">

    <div class="mb-8">
        <a href="{{ url('/dashboard') }}" class="text-indigo-600 font-bold flex items-center mb-2 hover:text-indigo-800 transition text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Retour au Dashboard
        </a>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">Soumettre ma <span class="text-indigo-600">Solution</span></h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Détails du Brief</h3>

                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-indigo-500 uppercase">Projet</p>
                        <p class="font-bold text-slate-800">{{ $brief->title }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-indigo-500 uppercase">Étape</p>
                        <p class="font-bold text-slate-800">{{ $brief->sprint?->name ?? 'Sprint Global' }}</p>
                    </div>
                    <div class="pt-4 border-t border-slate-50">
                        <p class="text-xs text-slate-500 italic leading-relaxed">
                            {{ Str::limit($brief->description, 150) }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="bg-amber-50 p-6 rounded-[2rem] border border-amber-100">
                <p class="text-amber-700 text-xs font-bold leading-relaxed">
                    💡 <strong>Conseil :</strong> Assurez-vous que votre lien GitHub est public ou que vous avez inclus toutes les étapes de votre raisonnement.
                </p>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <form method="POST" action="{{ route('submissions.store') }}" class="p-8 md:p-10 space-y-6">
                    @csrf
                    <input type="hidden" name="brief_id" value="{{ $brief->id }}">

                    <div class="space-y-2">
                        <label for="content" class="block text-sm font-black text-slate-700 uppercase tracking-wider ml-1">
                            Votre Travail (Lien ou Texte)
                        </label>
                        <textarea name="content" id="content" rows="12" required
                            class="w-full px-6 py-5 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all font-mono text-sm placeholder:text-slate-300 shadow-inner bg-slate-50/30"
                            placeholder="Collez ici le lien de votre dépôt GitHub ou rédigez votre réponse détaillée..."></textarea>
                        @error('content')
                            <p class="text-rose-500 text-xs font-bold mt-2 ml-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-4 flex flex-col md:flex-row gap-4">
                        <button type="submit" class="flex-grow bg-indigo-600 text-white px-8 py-4 rounded-2xl font-black shadow-xl shadow-indigo-100 hover:bg-indigo-700 hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center">
                            Envoyer mon travail
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </button>

                        <a href="{{ url('/dashboard') }}" class="px-8 py-4 bg-slate-100 text-slate-500 rounded-2xl font-black text-center hover:bg-slate-200 transition-all uppercase text-[10px] tracking-widest flex items-center justify-center">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
