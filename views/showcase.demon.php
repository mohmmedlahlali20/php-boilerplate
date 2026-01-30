@extends('layouts/master')

@section('main_content')
<div class="max-w-7xl mx-auto px-6 py-24">
    <div class="text-center mb-24">
        <div class="inline-block px-4 py-1 border border-demon-crimson text-demon-crimson text-[10px] font-bold uppercase tracking-[0.3em] mb-6">
            Armory Preview
        </div>
        <h1 class="text-5xl md:text-7xl font-bold text-white uppercase tracking-tighter mb-8 leading-none">
            Forge <span class="text-demon-crimson">Components</span>
        </h1>
        <p class="text-lg text-gray-500 max-w-2xl mx-auto font-medium">
            A brutalist design system engineered for maximum impact. Ready to be integrated into your next high-performance deployment.
        </p>
    </div>

    <!-- Buttons Section -->
    <section class="mb-32">
        <div class="flex items-center gap-4 mb-12">
            <h2 class="text-2xl font-bold text-white uppercase tracking-tighter">Tactical Actions</h2>
            <div class="h-[1px] flex-1 bg-demon-crimson/20"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 p-12 demon-glass-sharp border-white/5 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-demon-crimson to-transparent"></div>
            
            <!-- Primary -->
            <div class="flex flex-col items-center gap-4">
                <button class="w-full py-4 bg-demon-crimson text-white font-bold text-xs uppercase tracking-widest hover:shadow-[0_0_20px_rgba(255,0,60,0.5)] transition-all active:scale-95">
                    Execute
                </button>
                <span class="text-[10px] text-gray-600 font-mono">crimson-solid</span>
            </div>
            
            <!-- Secondary -->
            <div class="flex flex-col items-center gap-4">
                <button class="w-full py-4 bg-white text-black font-bold text-xs uppercase tracking-widest hover:bg-demon-crimson hover:text-white transition-all active:scale-95">
                    Reinforce
                </button>
                <span class="text-[10px] text-gray-600 font-mono">ivory-shift</span>
            </div>

            <!-- Outline -->
            <div class="flex flex-col items-center gap-4">
                <button class="w-full py-4 border border-demon-crimson text-demon-crimson font-bold text-xs uppercase tracking-widest hover:bg-demon-crimson/10 transition-all active:scale-95">
                    Withdraw
                </button>
                <span class="text-[10px] text-gray-600 font-mono">crimson-ghost</span>
            </div>

             <!-- Sharp -->
             <div class="flex flex-col items-center gap-4">
                <button class="w-full py-4 bg-demon-charcoal border border-white/10 text-white font-bold text-xs uppercase tracking-widest hover:border-white/40 transition-all active:scale-95">
                    Stealth
                </button>
                <span class="text-[10px] text-gray-600 font-mono">obsidian-edge</span>
            </div>
        </div>
    </section>

    <!-- Cards Section -->
    <section class="mb-32">
        <div class="flex items-center gap-4 mb-12">
            <h2 class="text-2xl font-bold text-white uppercase tracking-tighter">Data Containment</h2>
            <div class="h-[1px] flex-1 bg-demon-crimson/20"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Glass Card -->
            <div class="demon-glass-sharp border-white/5 p-8 group hover:border-demon-crimson/40 transition-colors">
                <div class="w-12 h-12 bg-demon-crimson/10 border border-demon-crimson/20 flex items-center justify-center text-demon-crimson mb-8">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white uppercase mb-4">Hardened Vault</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-8">
                    Military-grade encryption for your most sensitive application state. Zero leakage protocols active.
                </p>
                <div class="pt-6 border-t border-white/5 flex justify-between items-center">
                    <span class="text-[10px] font-bold text-gray-600 uppercase tracking-widest">Status: Locked</span>
                    <a href="#" class="text-demon-crimson text-xs font-bold uppercase hover:underline">Access</a>
                </div>
            </div>

            <!-- Visual Card -->
            <div class="relative h-[400px] overflow-hidden group border border-white/5">
                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=800&q=80" alt="Tech" class="absolute inset-0 h-full w-full object-cover grayscale transition-all duration-700 group-hover:scale-110 group-hover:grayscale-0">
                <div class="absolute inset-0 bg-gradient-to-t from-demon-obsidian via-demon-obsidian/40 to-transparent"></div>
                <div class="absolute bottom-0 p-8 w-full">
                    <span class="text-demon-crimson font-bold uppercase tracking-[0.2em] text-[10px] mb-2 block">Neural Link</span>
                    <h3 class="text-2xl font-bold text-white uppercase tracking-tight mb-2">Abyssal Intelligence</h3>
                    <p class="text-gray-400 text-xs opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        The neural engine processing your sub-millisecond requests.
                    </p>
                </div>
                <div class="absolute top-0 left-0 w-1 h-0 bg-demon-crimson group-hover:h-full transition-all duration-500"></div>
            </div>

            <!-- Gradient Card -->
            <div class="bg-gradient-to-br from-demon-charcoal to-demon-obsidian border border-demon-crimson/30 p-10 flex flex-col justify-between relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-demon-crimson/10 blur-3xl rounded-full"></div>
                <div>
                   <h3 class="text-3xl font-bold text-white uppercase tracking-tighter mb-4 leading-none">Nether<br>Status</h3>
                   <div class="space-y-4 mt-8">
                       <div class="flex justify-between items-center">
                           <span class="text-[10px] text-gray-500 font-bold uppercase">Uptime</span>
                           <span class="text-[10px] text-white font-mono">99.999%</span>
                       </div>
                       <div class="h-1 bg-white/5 rounded-full overflow-hidden">
                           <div class="h-full bg-demon-crimson w-full animate-pulse"></div>
                       </div>
                   </div>
                </div>
                <button class="mt-12 py-4 bg-demon-crimson text-white font-bold text-xs uppercase tracking-widest">
                    Reboot Protocol
                </button>
            </div>
        </div>
    </section>

    <!-- Forms Section -->
    <section class="max-w-4xl mx-auto">
         <div class="flex items-center gap-4 mb-12">
            <h2 class="text-2xl font-bold text-white uppercase tracking-tighter">Command Inputs</h2>
            <div class="h-[1px] flex-1 bg-demon-crimson/20"></div>
        </div>

        <div class="demon-glass-sharp border-white/5 p-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-4">Frequency Link</label>
                    <input type="email" class="w-full bg-demon-obsidian border border-white/10 px-6 py-4 text-white text-sm outline-none focus:border-demon-crimson transition-colors" placeholder="user@void.demon">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-4">Clearance Level</label>
                    <select class="w-full bg-demon-obsidian border border-white/10 px-6 py-4 text-white text-sm outline-none focus:border-demon-crimson transition-colors appearance-none">
                        <option>Infernal Overseer</option>
                        <option>Lost Soul</option>
                        <option>Nether Walker</option>
                    </select>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
