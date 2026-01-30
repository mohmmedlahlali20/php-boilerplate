@extends('layouts/master')

@section('main_content')
<div class="max-w-4xl mx-auto px-6 py-24">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter mb-4">Containment Lab</h1>
        <p class="text-lg text-demon-crimson font-bold uppercase tracking-[0.2em]">Testing Framework Defenses</p>
    </div>

    <!-- CSRF Test Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <!-- VULNERABLE FORM -->
        <div class="bg-black/50 border border-red-900/40 p-8 relative overflow-hidden group">
            <div class="absolute top-0 right-0 bg-red-900/20 text-red-500 text-[8px] font-bold px-3 py-1 tracking-widest uppercase border-b border-l border-red-900/40">Compromised</div>
            <h3 class="text-xl font-bold text-white uppercase tracking-tighter mb-4">Unprotected Entry</h3>
            <p class="text-gray-500 mb-8 text-xs leading-loose">
                This form bypasses the standard <span class="text-red-500">&#64;CSRF</span> protocol. Submitting this will trigger a breach in unprotected environments.
            </p>
            <form action="/security-test/unsafe" method="POST">
                <div class="mb-6">
                    <label class="block text-[10px] font-bold text-gray-600 uppercase tracking-widest mb-3">Payload Data</label>
                    <input type="text" name="secret" class="w-full bg-red-900/5 border border-red-900/20 px-4 py-3 text-white text-sm outline-none focus:border-red-500 transition-colors" placeholder="Inject secret...">
                </div>
                <button type="submit" class="w-full py-4 bg-red-900/20 border border-red-900/40 text-red-500 font-bold text-[10px] uppercase tracking-widest hover:bg-red-900 group-hover:text-white transition-all">
                    Initiate Breach
                </button>
            </form>
        </div>

        <!-- SECURE FORM -->
        <div class="bg-black/50 border border-demon-crimson/20 p-8 relative overflow-hidden group">
             <div class="absolute top-0 right-0 bg-demon-crimson/10 text-demon-crimson text-[8px] font-bold px-3 py-1 tracking-widest uppercase border-b border-l border-demon-crimson/30">Hardened</div>
            <h3 class="text-xl font-bold text-white uppercase tracking-tighter mb-4">Sanitized Vault</h3>
            <p class="text-gray-500 mb-8 text-xs leading-loose">
                This form utilizes the <span class="text-demon-crimson">&#64;CSRF</span> ritual. The Abyssal Guard will verify the token before granting access.
            </p>
            <form action="/security-test/safe" method="POST">
                @CSRF
                <div class="mb-6">
                    <label class="block text-[10px] font-bold text-gray-600 uppercase tracking-widest mb-3">Secure Payload</label>
                    <input type="text" name="secret" class="w-full bg-demon-obsidian border border-demon-crimson/20 px-4 py-3 text-white text-sm outline-none focus:border-demon-crimson transition-colors" placeholder="Encrypted data...">
                </div>
                <button type="submit" class="w-full py-4 bg-demon-crimson text-white font-bold text-[10px] uppercase tracking-widest hover:shadow-[0_0_20px_rgba(255,0,60,0.4)] transition-all">
                    Secure Transmission
                </button>
            </form>
        </div>
    </div>

    <!-- Auth Test Section -->
    <div class="demon-glass-sharp border-white/5 p-12 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 w-2 h-2 bg-demon-crimson"></div>
        <div class="absolute bottom-0 right-0 w-2 h-2 bg-demon-crimson"></div>
        
        <h3 class="text-2xl font-bold text-white uppercase tracking-tighter mb-6">Restricted Sector</h3>
        <p class="text-gray-500 mb-10 max-w-xl mx-auto text-sm leading-relaxed">
            Testing the <code>auth</code> sentry. Attempting to enter this sector without a validated soul will result in immediate redirection to the void.
        </p>
        <div class="flex justify-center">
             <a href="/admin" class="px-10 py-4 bg-white text-black font-extrabold text-[10px] uppercase tracking-[0.2em] hover:bg-demon-crimson hover:text-white transition-all">
                 Infiltrate Admin Sector
            </a>
        </div>
    </div>

    <div class="mt-20 text-center">
        <p class="text-[10px] font-bold text-gray-700 uppercase tracking-[0.4em]">Demon Framework Security Protocol Active</p>
    </div>
</div>
@endsection
