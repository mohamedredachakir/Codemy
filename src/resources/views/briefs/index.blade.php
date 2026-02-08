@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-black text-slate-800 tracking-tight">Liste des <span class="text-indigo-600">Briefs</span></h1>

        {{-- قمت بتغيير الرابط هنا إلى url('/dashboard') لضمان عدم حدوث خطأ --}}
        <a href="{{ url('/dashboard') }}" class="px-5 py-2 bg-slate-100 text-slate-600 rounded-xl font-bold text-sm hover:bg-slate-200 transition">
            Retour au Dashboard
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if(isset($briefs) && $briefs->count() > 0)
            @foreach($briefs as $brief)
                <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl p-6 flex flex-col hover:shadow-2xl transition-all duration-300">

                    <div class="mb-4">
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-indigo-100">
                            {{-- استخدمنا الـ Optional لضمان عدم حدوث Bug في الاسم --}}
                            {{ optional($brief->schoolclass)->name ?? 'Sans Classe' }}
                        </span>
                    </div>

                    <div class="flex-grow">
                        <h2 class="text-xl font-black text-slate-800 mb-2 leading-tight">{{ $brief->title }}</h2>
                        <p class="text-slate-500 text-sm line-clamp-3 mb-6 italic">{{ $brief->description }}</p>
                    </div>

                    <div class="flex items-center gap-4 text-slate-400 text-[11px] font-bold uppercase mb-6 border-t pt-4">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $brief->estimated_time }} Heures
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('briefs.edit', $brief->id) }}" class="flex justify-center py-2.5 text-[10px] font-black text-amber-600 bg-amber-50 rounded-xl hover:bg-amber-600 hover:text-white transition-all uppercase tracking-widest">
                            Modifier
                        </a>
                        <a href="{{ route('briefs.show', $brief->id) }}" class="flex justify-center py-2.5 text-[10px] font-black text-white bg-indigo-600 rounded-xl hover:bg-indigo-700 transition-all uppercase tracking-widest shadow-md">
                            Évaluer
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-span-full py-20 text-center bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                <p class="text-slate-400 font-bold">Aucun brief trouvé.</p>
            </div>
        @endif
    </div>
</div>
@endsection
