<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BriefMaster | Home</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
        
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
            .text-outline { -webkit-text-stroke: 1px #4f46e5; color: transparent; }
        </style>
    </head>
    <body class="bg-[#FDFDFC] text-slate-900 min-h-screen flex flex-col items-center">
        
        <header class="w-full max-w-6xl px-6 py-10 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-xl shadow-indigo-200">B</div>
                <span class="text-xl font-black tracking-tighter uppercase italic">Brief<span class="text-indigo-600">Master</span></span>
            </div>
            
            <nav class="flex items-center gap-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition">Connexion</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-6 py-3 bg-slate-900 text-white rounded-xl text-xs font-black uppercase tracking-widest shadow-xl hover:bg-indigo-600 transition-all">S'inscrire</a>
                    @endif
                @endauth
            </nav>
        </header>

        <main class="w-full max-w-6xl px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center py-10">
            
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg border border-indigo-100">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-[10px] font-black uppercase tracking-widest">Système de gestion pédagogique</span>
                </div>

                <h1 class="text-6xl lg:text-8xl font-black text-slate-900 leading-[0.85] tracking-tight">
                    Gérez vos <br> <span class="text-indigo-600">Projets</span> <br> <span class="text-outline">Efficacement.</span>
                </h1>

                <p class="text-lg text-slate-400 font-medium leading-relaxed max-w-md">
                    Une plateforme intuitive pour centraliser vos briefs, suivre vos sprints et valider vos compétences en un clic.
                </p>
                
                <div class="flex items-center gap-4 pt-4">
                    <a href="{{ route('login') }}" class="px-10 py-5 bg-indigo-600 text-white rounded-[1.5rem] font-black uppercase tracking-widest text-xs shadow-2xl shadow-indigo-200 hover:scale-105 transition-all">
                        Découvrir la plateforme
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-50 space-y-4 hover:-translate-y-2 transition-transform duration-500">
                    <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Briefs & Sprints</h3>
                    <p class="text-xs text-slate-400 leading-relaxed font-medium">Accédez à tous vos projets et organisez votre travail par sprints hebdomadaires.</p>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-50 space-y-4 hover:-translate-y-2 transition-transform duration-500">
                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Évaluations</h3>
                    <p class="text-xs text-slate-400 leading-relaxed font-medium">Suivez votre progression en temps réel avec des feedbacks détaillés par compétence.</p>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-50 space-y-4 hover:-translate-y-2 transition-transform duration-500">
                    <div class="w-12 h-12 bg-rose-50 rounded-2xl flex items-center justify-center text-rose-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Délais</h3>
                    <p class="text-xs text-slate-400 leading-relaxed font-medium">Ne manquez plus aucune échéance grâce au système de détection automatique des retards.</p>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-50 space-y-4 hover:-translate-y-2 transition-transform duration-500">
                    <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="font-black text-slate-800 text-sm uppercase tracking-widest">Classes</h3>
                    <p class="text-xs text-slate-400 leading-relaxed font-medium">Gestion simplifiée des classes et des promotions pour une meilleure organisation.</p>
                </div>

            </div>
        </main>

        <footer class="w-full max-w-6xl px-6 mt-20 py-10 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-300">© {{ date('Y') }} Brief Master - Platform</p>
            <div class="flex gap-6">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</span>
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">PHP v{{ PHP_VERSION }}</span>
            </div>
        </footer>
    </body>
</html>