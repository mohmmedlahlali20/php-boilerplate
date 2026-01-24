@extends('layouts/master')

@section('main_content')
<div class="font-sans antialiased text-gray-900 bg-white">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-white">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-gradient-to-br from-blue-100 to-purple-100 blur-3xl opacity-50 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-gradient-to-tr from-pink-100 to-yellow-100 blur-3xl opacity-50 animate-pulse animation-delay-2000"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-16 lg:pt-32 lg:pb-24 text-center">
            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-100 mb-8 transform transition hover:scale-105 cursor-pointer shadow-sm">
                <span class="w-2 h-2 mr-2 bg-blue-500 rounded-full animate-pulse"></span>
                v1.0.0 is now live
            </span>
            
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-8 leading-tight">
                Build faster with <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Med Framework</span>
            </h1>
            
            <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500 mb-10">
                A lightweight, modern PHP framework designed for speed and simplicity. 
                Crafted with developer experience in mind.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="/docs" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-blue-600 border border-transparent rounded-xl hover:bg-blue-700 hover:shadow-lg hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600">
                    Get Started
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
                <a href="#features" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-gray-700 transition-all duration-200 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 hover:border-gray-300 hover:shadow-md hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">
                    Full Documentation
                </a>
            </div>
            
            <!-- Code preview -->
            <div class="mt-20 relative max-w-4xl mx-auto transform rotate-1 hover:rotate-0 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-600 transform scale-105 rounded-2xl blur-lg opacity-20"></div>
                <div class="relative bg-gray-900 rounded-2xl shadow-2xl overflow-hidden border border-gray-800">
                    <div class="flex items-center px-4 py-3 bg-gray-800 border-b border-gray-700">
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        </div>
                        <div class="flex-1 text-center text-sm font-mono text-gray-400">
                            routes/web.php
                        </div>
                    </div>
                    <div class="p-6 overflow-x-auto text-left">
                        <pre class="font-mono text-sm leading-6">
<span class="text-purple-400">use</span> <span class="text-blue-300">App\Core\Router\Router</span>;

<span class="text-blue-300">Router</span>::<span class="text-yellow-300">get</span>(<span class="text-green-300">'/'</span>, <span class="text-purple-400">function</span>() {
    <span class="text-purple-400">return</span> <span class="text-yellow-300">render</span>(<span class="text-green-300">'home'</span>, [
        <span class="text-green-300">'title'</span> => <span class="text-green-300">'Welcome'</span>
    ]);
});</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Grid -->
    <div id="features" class="py-24 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-blue-600 font-semibold tracking-wide uppercase">Features</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Everything you need to ship
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    A complete toolkit for building modern applications without the bloat.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Blazing Fast</h3>
                    <p class="text-gray-500">
                        Optimized for performance with zero external dependencies in the core.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Modern Architecture</h3>
                    <p class="text-gray-500">
                        Built with MVC principles and a clean folder structure for scalability.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="w-12 h-12 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Easy Customization</h3>
                    <p class="text-gray-500">
                        Tailwind CSS support right out of the box for rapid UI development.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection