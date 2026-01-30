@extends('layouts/demon')

@section('main_content')
<!-- Hero Section -->
<section class="min-h-screen flex flex-col justify-center items-center px-6 pt-32 pb-20 overflow-hidden relative">
    <div class="absolute inset-0 z-0">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-demon-crimson/5 rounded-full blur-[120px] animate-pulse-slow"></div>
    </div>

    <div class="relative z-10 text-center max-w-5xl">
        <div class="inline-flex items-center gap-3 px-4 py-2 demon-glass-sharp border border-demon-crimson/30 rounded-full mb-8 transform hover:scale-105 transition-transform cursor-default">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-demon-crimson opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-demon-crimson"></span>
            </span>
            <span class="text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Stable Version 6.6.6 is out</span>
        </div>

        <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold tracking-[ -0.05em] leading-[0.9] text-white uppercase mb-8">
            DEVILISH <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-b from-white to-demon-charcoal demon-glow-text" style="-webkit-text-stroke: 1px rgba(255, 255, 255, 0.1);">SPEED.</span>
        </h1>

        <p class="text-lg md:text-xl text-gray-400 max-w-2xl mx-auto mb-12 font-medium tracking-tight">
            The frontend library for those who demand <span class="text-demon-crimson">absolute dominance</span>. Razor-sharp components, aggressive performance, and an aesthetic that intimidates.
        </p>

        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
            <a href="#" class="group relative px-10 py-5 bg-demon-crimson text-white font-bold uppercase tracking-widest text-sm transition-all duration-300 hover:shadow-[0_0_30px_rgba(255,0,60,0.6)] active:scale-95">
                Forge Your App
                <div class="absolute inset-0 border border-white/20 group-hover:scale-110 transition-transform duration-300"></div>
            </a>
            <a href="#" class="px-10 py-5 demon-glass-sharp border border-white/10 text-white font-bold uppercase tracking-widest text-sm hover:border-demon-crimson/50 hover:bg-white/5 transition-all active:scale-95">
                Read the Grimoire
            </a>
        </div>
    </div>

    <div class="mt-32 w-full max-w-6xl relative group">
        <div class="absolute -inset-1 bg-gradient-to-r from-demon-crimson to-transparent opacity-20 blur group-hover:opacity-40 transition duration-1000"></div>
        <div class="relative demon-glass-sharp border border-white/10 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-3 bg-white/5 border-b border-white/10">
                <div class="flex gap-2">
                    <div class="w-2 h-2 rounded-full bg-red-500"></div>
                    <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                    <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                </div>
                <div class="text-[10px] uppercase tracking-widest text-gray-500 font-bold">demon-component.dm</div>
                <div class="w-10"></div>
            </div>
            <div class="p-8 md:p-12 font-mono text-sm leading-relaxed overflow-x-auto">
                <pre class="grid grid-cols-1 gap-1">
<div class="flex gap-4"><span class="text-gray-600 select-none">01</span><span class="text-demon-crimson">import</span> { <span class="text-white">Forge</span>, <span class="text-white">Soul</span> } <span class="text-demon-crimson">from</span> <span class="text-emerald-400">'@demon-core'</span>;</div>
<div class="flex gap-4"><span class="text-gray-600 select-none">02</span></div>
<div class="flex gap-4"><span class="text-gray-600 select-none">03</span><span class="text-demon-crimson">const</span> <span class="text-blue-400">HellboundComponent</span> = <span class="text-white">Soul</span>(({ <span class="text-white">power</span> }) => {</div>
<div class="flex gap-4"><span class="text-gray-600 select-none">04</span>  <span class="text-demon-crimson">const</span> [<span class="text-white">heat</span>, <span class="text-white">setHeat</span>] = <span class="text-white">Forge</span>.<span class="text-yellow-300">ignite</span>(<span class="text-white">power</span> * <span class="text-white">666</span>);</div>
<div class="flex gap-4"><span class="text-gray-600 select-none">05</span></div>
<div class="flex gap-4"><span class="text-gray-600 select-none">06</span>  <span class="text-demon-crimson">return</span> (</div>
<div class="flex gap-4"><span class="text-gray-600 select-none">07</span>    <span class="text-gray-500">&lt;</span><span class="text-demon-crimson">div</span> <span class="text-blue-300">className</span>=<span class="text-emerald-400">"void-container"</span><span class="text-gray-500">&gt;</span></div>
<div class="flex gap-4"><span class="text-gray-600 select-none">08</span>      <span class="text-gray-500">&lt;</span><span class="text-demon-crimson">h1</span><span class="text-gray-500">&gt;</span>Current Temperature: {<span class="text-white">heat</span>}K<span class="text-gray-500">&lt;/</span><span class="text-demon-crimson">h1</span><span class="text-gray-500">&gt;</span></div>
<div class="flex gap-4"><span class="text-gray-600 select-none">09</span>      <span class="text-gray-500">&lt;</span><span class="text-demon-crimson">button</span> <span class="text-blue-300">onClick</span>={<span class="text-white">() => setHeat(h => h + 1)</span>}<span class="text-gray-500">&gt;</span>Increase Suffering<span class="text-gray-500">&lt;/</span><span class="text-demon-crimson">button</span><span class="text-gray-500">&gt;</span></div>
<div class="flex gap-4"><span class="text-gray-600 select-none">10</span>    <span class="text-gray-500">&lt;/</span><span class="text-demon-crimson">div</span><span class="text-gray-500">&gt;</span></div>
<div class="flex gap-4"><span class="text-gray-600 select-none">11</span>  );</div>
<div class="flex gap-4"><span class="text-gray-600 select-none">12</span>});</pre>
            </div>
        </div>
    </div>
</section>

<!-- Bento Grid Features -->
<section class="max-w-7xl mx-auto px-6 py-32">
    <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
        <div class="max-w-xl">
            <h2 class="text-4xl md:text-6xl font-bold text-white uppercase tracking-tighter mb-6">Infernal Features</h2>
            <p class="text-gray-500 text-lg uppercase tracking-widest font-bold">Uncompromising capability for the modern web.</p>
        </div>
        <div class="text-right">
            <span class="text-8xl font-black text-white/5 select-none">01-06</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-6 grid-rows-auto gap-4">
        <!-- Feature 1: Big Card -->
        <div class="md:col-span-4 md:row-span-2 demon-glass-sharp border-white/5 p-12 relative overflow-hidden group hover:border-demon-crimson/40 transition-colors duration-500">
            <div class="absolute top-0 right-0 p-8">
                <svg class="w-12 h-12 text-demon-crimson animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div class="relative z-10">
                <h3 class="text-3xl font-bold text-white uppercase tracking-tighter mb-4">Devilish Speed</h3>
                <p class="text-gray-400 text-lg max-w-md">
                    Our hydration engine is optimized to the bone. Zero-latency transitions and sub-millisecond response times mean your users never wait.
                </p>
                <div class="mt-12 flex gap-4">
                    <div class="h-1 flex-1 bg-white/10 relative overflow-hidden">
                        <div class="absolute inset-0 bg-demon-crimson w-2/3"></div>
                    </div>
                    <span class="text-[10px] font-bold text-demon-crimson uppercase tracking-widest">Hydration Speed: 0.2ms</span>
                </div>
            </div>
            <div class="absolute bottom-[-50px] left-[-50px] w-64 h-64 bg-demon-crimson/10 rounded-full blur-3xl group-hover:bg-demon-crimson/20 transition-all duration-700"></div>
        </div>

        <!-- Feature 2: Small Card -->
        <div class="md:col-span-2 demon-glass-sharp border-white/5 p-8 hover:border-demon-crimson/40 transition-colors group">
            <h3 class="text-xl font-bold text-white uppercase tracking-tighter mb-4">Shadow DOM</h3>
            <p class="text-sm text-gray-500">Total isolation by default. Styles never leak, components never conflict.</p>
            <div class="mt-8 flex justify-end">
                <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center group-hover:border-demon-crimson transition-colors">
                    <svg class="w-4 h-4 text-gray-600 group-hover:text-demon-crimson" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </div>

        <!-- Feature 3: Small Card -->
        <div class="md:col-span-2 demon-glass-sharp border-white/5 p-8 hover:border-demon-crimson/40 transition-colors group">
            <h3 class="text-xl font-bold text-white uppercase tracking-tighter mb-4">Neon State</h3>
            <p class="text-sm text-gray-500">Reactive stores with zero boilerplate. State management that actually makes sense.</p>
            <div class="mt-8">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full bg-demon-crimson border-2 border-demon-obsidian"></div>
                    <div class="w-8 h-8 rounded-full bg-demon-charcoal border-2 border-demon-obsidian flex items-center justify-center">
                        <span class="text-[8px] text-white">N</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature 4: Medium Card -->
        <div class="md:col-span-3 demon-glass-sharp border-white/5 p-10 hover:border-demon-crimson/40 transition-colors">
            <h3 class="text-2xl font-bold text-white uppercase tracking-tighter mb-4">Razor Routing</h3>
            <p class="text-gray-500 mb-8 text-sm">Type-safe client-side routing that's blindingly fast. Predictive pre-fetching comes standard.</p>
            <div class="space-y-2">
                <div class="h-8 bg-white/5 rounded flex items-center px-4 gap-4">
                    <span class="text-demon-crimson text-[10px]">GET</span>
                    <span class="text-white text-[10px] font-mono">/vault/secrets</span>
                </div>
                <div class="h-8 bg-white/5 rounded flex items-center px-4 gap-4 opacity-50">
                    <span class="text-gray-500 text-[10px]">POST</span>
                    <span class="text-gray-500 text-[10px] font-mono">/auth/sacrifice</span>
                </div>
            </div>
        </div>

        <!-- Feature 5: Medium Card -->
        <div class="md:col-span-3 demon-glass-sharp border-white/5 p-10 hover:border-demon-crimson/40 transition-colors">
            <h3 class="text-2xl font-bold text-white uppercase tracking-tighter mb-4">Infernal CLI</h3>
            <p class="text-gray-500 mb-8 text-sm">Code generation at warp speed. Scaffold entire features with a single, brutal command.</p>
            <div class="bg-black/40 rounded p-4 font-mono text-[10px] border border-white/5">
                <span class="text-emerald-500">$</span> demon forge --app "Apocalypse"
                <br><span class="text-gray-600">Generating souls... Done in 0.04s</span>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-40 px-6 text-center">
    <div class="max-w-4xl mx-auto demon-glass-sharp p-20 border-white/5 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-demon-crimson/5 blur-3xl rounded-full translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-demon-crimson/5 blur-3xl rounded-full -translate-x-1/2 translate-y-1/2"></div>
        
        <h2 class="text-4xl md:text-5xl font-bold text-white uppercase tracking-tighter mb-8 leading-tight">Ready to sacrifice your old stack?</h2>
        <p class="text-gray-400 mb-12 max-w-xl mx-auto">Join the elite developers building the next generation of high-performance web applications.</p>
        
        <button class="px-12 py-6 bg-white text-black font-bold uppercase tracking-widest text-sm hover:bg-demon-crimson hover:text-white transition-all duration-500">
            Initiate Deployment
        </button>
    </div>
</section>
@endsection
