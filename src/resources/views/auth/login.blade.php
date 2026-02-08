@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center pt-10">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-[2rem] p-10 shadow-xl shadow-slate-200/50 border border-slate-100">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-extrabold text-slate-900">Bon retour !</h2>
                <p class="text-slate-500 mt-2 font-medium">Accédez à votre espace Codemy</p>
            </div>

            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Adresse Email</label>
                        <input id="email" name="email" type="email" required value="{{ old('email') }}"
                            class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                            placeholder="nom@ecole.com">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">Mot de passe</label>
                        <input id="password" name="password" type="password" required
                            class="w-full px-5 py-4 rounded-2xl border border-slate-200 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all placeholder:text-slate-400"
                            placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                        <label for="remember" class="ml-2 block text-sm text-slate-600 font-medium">
                            Se souvenir de moi
                        </label>
                    </div>
                    <a href="#" class="text-sm font-bold text-indigo-600 hover:text-indigo-700 transition">
                        Oublié ?
                    </a>
                </div>

                <button type="submit"
                    class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold hover:bg-indigo-600 transition-all duration-300 transform hover:scale-[1.02] active:scale-95 shadow-lg shadow-indigo-100">
                    Se connecter
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-slate-500 font-medium">
                Besoin d'aide ? <a href="#" class="text-indigo-600 font-bold hover:underline">Contacter l'Admin</a>
            </p>
        </div>
    </div>
</div>
@endsection
