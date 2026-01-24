@extends('layouts/master')

@section('main_content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Security Lab 🛡️</h1>
        <p class="text-xl text-gray-500">Test the framework's defenses against common web attacks.</p>
    </div>

    <!-- CSRF Test Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <!-- VULNERABLE FORM -->
        <div class="bg-red-50 border border-red-200 rounded-2xl p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">VULNERABLE</div>
            <h3 class="text-2xl font-bold text-red-900 mb-4">Unprotected Form</h3>
            <p class="text-red-700 mb-6 text-sm">
                This form submits data <strong>without</strong> a CSRF token. The server will accept it blindly if no middleware checks it.
            </p>
            <form action="/security-test/unsafe" method="POST">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-red-800 mb-1">Enter Secret Data</label>
                    <input type="text" name="secret" class="w-full px-4 py-2 border border-red-300 rounded-lg focus:ring-red-500 focus:border-red-500 bg-white" placeholder="e.g. Password123">
                </div>
                <button type="submit" class="w-full bg-red-600 text-white font-bold py-3 rounded-lg hover:bg-red-700 transition">
                    Submit Unsafe Request 🔓
                </button>
            </form>
        </div>

        <!-- SECURE FORM -->
        <div class="bg-green-50 border border-green-200 rounded-2xl p-8 relative overflow-hidden">
             <div class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">SECURE</div>
            <h3 class="text-2xl font-bold text-green-900 mb-4">Protected Form</h3>
            <p class="text-green-700 mb-6 text-sm">
                This form includes the <code class="bg-green-100 px-1 rounded font-mono">@CSRF</code> token. The middleware will validate it before processing.
            </p>
            <form action="/security-test/safe" method="POST">
                @CSRF
                <div class="mb-4">
                    <label class="block text-sm font-medium text-green-800 mb-1">Enter Secret Data</label>
                    <input type="text" name="secret" class="w-full px-4 py-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500 bg-white" placeholder="e.g. Password123">
                </div>
                <button type="submit" class="w-full bg-green-600 text-white font-bold py-3 rounded-lg hover:bg-green-700 transition">
                    Submit Secure Request 🔒
                </button>
            </form>
        </div>
    </div>

    <!-- Auth Test Section -->
    <div class="bg-gray-900 rounded-2xl p-8 text-center text-white">
        <h3 class="text-2xl font-bold mb-4">🔒 Middleware Protection</h3>
        <p class="text-gray-400 mb-6 max-w-2xl mx-auto">
            Try accessing a route protected by the <code>auth</code> middleware. If you are not logged in, you should be redirected.
        </p>
        <div class="flex justify-center space-x-4">
             <a href="/admin" class="px-6 py-3 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition flex items-center">
                 <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                 Success Protected Route
            </a>
        </div>
    </div>

    <div class="mt-12 text-center text-sm text-gray-400">
        <p>This lab demonstrates the active security features of your Med Framework.</p>
    </div>
</div>
@endsection
