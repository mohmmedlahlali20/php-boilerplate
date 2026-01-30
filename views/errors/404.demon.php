@extends('layouts/master')

@section('main_content')
<div class="relative flex items-center justify-center min-h-[calc(100vh-120px)] bg-demon-obsidian overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-demon-crimson/5 rounded-full blur-[120px] animate-pulse-slow"></div>

    <div class="relative z-10 text-center px-6 max-w-2xl mx-auto">
        <h1 class="text-[12rem] font-black text-transparent bg-clip-text bg-gradient-to-b from-demon-crimson to-demon-obsidian mb-4 leading-none select-none">404</h1>
        
        <div class="mb-12">
            <span class="inline-block px-4 py-1 border border-demon-crimson text-demon-crimson text-[10px] font-bold tracking-[0.3em] uppercase mb-8">
                Entity Not Found
            </span>
            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 uppercase tracking-tighter">
                LOST IN THE <span class="text-demon-crimson">ABYSS</span>
            </h2>
            <p class="text-gray-500 mb-12 font-medium tracking-tight text-lg">
                The sector you are attempting to access has been incinerated or never existed in this timeline.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
            <a href="/" class="group relative px-10 py-5 bg-demon-crimson text-white font-bold uppercase tracking-widest text-xs transition-all duration-300 hover:shadow-[0_0_30px_rgba(255,0,60,0.6)] active:scale-95">
                Return to Surface
                <div class="absolute inset-0 border border-white/20 group-hover:scale-110 transition-transform duration-300"></div>
            </a>
            
            <button onclick="window.history.back()" class="px-10 py-5 demon-glass-sharp border border-white/10 text-white font-bold uppercase tracking-widest text-xs hover:border-demon-crimson/50 hover:bg-white/5 transition-all active:scale-95">
                Retreat
            </button>
        </div>
    </div>
</div>
@endsection