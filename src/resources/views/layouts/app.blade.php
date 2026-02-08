<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Codemy') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(10px); }
    </style>
</head>
<body class="bg-[#f8fafc] min-h-screen text-slate-900">

    <nav class="bg-white/80 sticky top-0 z-50 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="bg-indigo-600 p-2 rounded-lg text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <span class="text-2xl font-black text-slate-800 tracking-tight">CODE<span class="text-indigo-600">MY</span></span>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-slate-600 hover:text-indigo-600 font-semibold transition">Accueil</a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-slate-600 hover:text-indigo-600 font-semibold transition">Tableau de bord</a>
                        <div class="flex items-center space-x-4">
                            <span class="text-sm bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full font-medium">{{ Auth::user()->role }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-slate-500 hover:text-red-600 font-bold transition">Déconnexion</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="bg-indigo-600 text-white px-6 py-2.5 rounded-xl font-bold hover:bg-indigo-700 hover:shadow-lg hover:shadow-indigo-200 transition-all duration-300">
                            Connexion
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto mt-10 px-4 sm:px-6 lg:px-8 pb-20">
        @if(session('success'))
            <div class="flex items-center p-4 mb-6 text-emerald-800 rounded-2xl bg-emerald-50 border border-emerald-100 shadow-sm" role="alert">
                <svg class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <div class="ml-3 text-sm font-medium">{{ session('success') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 mb-6 text-red-800 rounded-2xl bg-red-50 border border-red-100 shadow-sm" role="alert">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                    <span class="font-bold">Attention!</span>
                </div>
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

</body>
</html>
