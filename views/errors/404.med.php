@extends('layouts/master')

@section('main_content')
<div class="relative flex items-center justify-center min-h-[calc(100vh-120px)] bg-gray-50 overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-1/4 w-96 h-96 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
    <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>

    <div class="relative z-10 text-center px-6 max-w-2xl mx-auto">
        <h1 class="text-9xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 mb-4 drop-shadow-sm">404</h1>
        
        <div class="mb-8">
            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold tracking-wider text-blue-800 bg-blue-100 uppercase mb-4">
                Error Code
            </span>
            <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-6 tracking-tight">
                Lost in Space?
            </h2>
            <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                The page you are looking for seems to have drifted away into the digital void. Let's get you back on track.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/" class="group relative inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-white transition-all duration-200 bg-gray-900 font-pj rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 hover:bg-gray-800 hover:shadow-lg hover:-translate-y-1">
                <span class="absolute top-0 right-0 w-3 h-3 -mt-1 -mr-1 rounded-full bg-green-500 animate-ping"></span>
                <span class="absolute top-0 right-0 w-3 h-3 -mt-1 -mr-1 rounded-full bg-green-500"></span>
                Back to Home
                <svg class="w-5 h-5 ml-2 -mr-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
            
            <button onclick="window.history.back()" class="inline-flex items-center justify-center px-8 py-3.5 text-base font-bold text-gray-700 transition-all duration-200 bg-white border border-gray-200 rounded-xl font-pj focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 hover:bg-gray-50 hover:text-gray-900 hover:border-gray-300 hover:shadow-md">
                Go Back
            </button>
        </div>
    </div>
</div>

@endsection