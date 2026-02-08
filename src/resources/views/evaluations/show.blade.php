@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4 space-y-8">

    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col md:flex-row justify-between items-end gap-6">
        <div>
            <span class="inline-flex items-center px-3 py-1 rounded-lg bg-indigo-50 text-indigo-600 text-[10px] font-black uppercase tracking-widest border border-indigo-100 mb-3">
                Résultats d'évaluation
            </span>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">{{ $brief->title }}</h1>
            <p class="text-slate-500 font-medium mt-1">Sprint : <span class="text-slate-800 font-bold">{{ $brief->sprint?->name ?? 'N/A' }}</span></p>
        </div>
        <a href="{{ url('/dashboard') }}" class="px-6 py-3 bg-slate-900 text-white rounded-xl font-black text-xs uppercase tracking-widest hover:bg-indigo-600 transition-all shadow-lg shadow-slate-200">
            Retour au Dashboard
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Compétence</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Niveau</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">Commentaire</th>
                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-right">Evaluateur</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @foreach($evaluations as $evaluation)
                <tr class="hover:bg-slate-50/30 transition-colors">
                    <td class="px-8 py-6">
                        <div class="flex flex-col">
                            <span class="text-[10px] font-black text-indigo-500 uppercase tracking-tighter">{{ $evaluation->competence?->code ?? 'CODE' }}</span>
                            <span class="font-bold text-slate-800 text-sm">{{ $evaluation->competence?->label ?? 'Non défini' }}</span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @php
                            // استخراج القيمة النصية من الـ Enum بأمان
                            $levelValue = is_object($evaluation->level) ? $evaluation->level->value : $evaluation->level;
                            $levelLower = strtolower((string) $levelValue);

                            $badgeStyle = match($levelLower) {
                                'imiter' => 'bg-rose-50 text-rose-600 border-rose-100',
                                's_adapter' => 'bg-amber-50 text-amber-600 border-amber-100',
                                'transposeur' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                default => 'bg-slate-100 text-slate-600 border-slate-200'
                            };
                        @endphp
                        <span class="px-4 py-1.5 rounded-full border {{ $badgeStyle }} text-[10px] font-black uppercase tracking-widest">
                            {{ str_replace('_', ' ', $levelValue) }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-slate-500 text-sm italic">
                        {{ $evaluation->comment ?? 'Aucun commentaire.' }}
                    </td>
                    <td class="px-8 py-6 text-right">
                        <p class="text-xs font-black text-slate-800">{{ $evaluation->teacher?->first_name }} {{ $evaluation->teacher?->last_name }}</p>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
