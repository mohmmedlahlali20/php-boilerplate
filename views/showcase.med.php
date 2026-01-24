@extends('layouts/master')

@section('main_content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 mb-4">
            Interface Design System
        </h1>
        <p class="text-xl text-gray-500 max-w-2xl mx-auto">
            A collection of robust, pre-styled components ready to use in your next big idea.
        </p>
    </div>

    <!-- Buttons Section -->
    <section class="mb-20">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 pb-2 border-b border-gray-200">Buttons & Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-8 bg-white rounded-2xl shadow-sm border border-gray-100">
            <!-- Primary -->
            <div class="flex flex-col items-center justify-center space-y-4">
                <button class="px-6 py-2.5 bg-blue-600 text-white font-medium text-sm leading-tight rounded-lg shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                    Primary Button
                </button>
                <span class="text-xs text-gray-400 font-mono">bg-blue-600</span>
            </div>
            
            <!-- Secondary -->
            <div class="flex flex-col items-center justify-center space-y-4">
                <button class="px-6 py-2.5 bg-purple-600 text-white font-medium text-sm leading-tight rounded-lg shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out">
                    Secondary Action
                </button>
                <span class="text-xs text-gray-400 font-mono">bg-purple-600</span>
            </div>

            <!-- Outline -->
            <div class="flex flex-col items-center justify-center space-y-4">
                <button class="px-6 py-2.5 border-2 border-blue-600 text-blue-600 font-medium text-sm leading-tight rounded-lg hover:bg-blue-50 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                    Outline Button
                </button>
                <span class="text-xs text-gray-400 font-mono">border-blue-600</span>
            </div>

             <!-- Ghost -->
             <div class="flex flex-col items-center justify-center space-y-4">
                <button class="px-6 py-2.5 text-gray-600 font-medium text-sm leading-tight rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                    Ghost Button
                </button>
                <span class="text-xs text-gray-400 font-mono">hover:bg-gray-100</span>
            </div>
        </div>
    </section>

    <!-- Cards Section -->
    <section class="mb-20">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 pb-2 border-b border-gray-200">Interactive Cards</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Card 1: Glassmorphism -->
            <div class="relative group h-96 w-full overflow-hidden bg-gray-900 rounded-2xl shadow-xl">
                 <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Tech" class="absolute inset-0 h-full w-full object-cover transition-transform duration-500 group-hover:scale-110 opacity-60 group-hover:opacity-40">
                 <div class="absolute bottom-0 p-8 w-full bg-gradient-to-t from-gray-900 to-transparent">
                    <div class="translate-y-4 transform transition-transform duration-300 group-hover:translate-y-0">
                        <span class="text-blue-400 font-bold uppercase tracking-widest text-xs">Technology</span>
                        <h3 class="mt-2 text-2xl font-bold text-white">Future of AI</h3>
                        <p class="mt-2 text-gray-300 text-sm opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                            Explore how artificial intelligence handles generic layouts.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Minimal -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 hover:shadow-xl transition-shadow duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center text-pink-500 mb-6">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Made with Love</h3>
                    <p class="text-gray-500 leading-relaxed">
                        Every component is crafted with attention to detail, ensuring a premium feel for your users.
                    </p>
                </div>
                <div class="mt-8 pt-6 border-t border-gray-50 flex items-center justify-between">
                     <span class="text-sm text-gray-400">Mar 10, 2024</span>
                     <a href="#" class="text-pink-600 font-medium hover:text-pink-700 text-sm">Read more &rarr;</a>
                </div>
            </div>

            <!-- Card 3: Gradient -->
             <div class="bg-gradient-to-br from-purple-600 to-indigo-700 rounded-2xl shadow-xl p-8 text-white flex flex-col justify-center text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-10 blur-2xl"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 rounded-full bg-pink-500 opacity-20 blur-3xl"></div>
                
                <h3 class="relative z-10 text-3xl font-bold mb-4">Pro Features</h3>
                <p class="relative z-10 text-indigo-100 mb-8">Unlock the full potential with our premium tools.</p>
                <button class="relative z-10 w-full py-3 bg-white text-indigo-600 rounded-xl font-bold shadow-lg hover:shadow-xl hover:bg-gray-50 transition-all">
                    Upgrade Now
                </button>
            </div>
        </div>
    </section>

    <!-- Inputs & Forms -->
    <section class="mb-20">
         <h2 class="text-2xl font-bold text-gray-900 mb-8 pb-2 border-b border-gray-200">Forms & Inputs</h2>
         <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Simple Input -->
                <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                     <div class="relative">
                         <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                         </div>
                         <input type="email" class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-shadow outline-none text-gray-700" placeholder="you@example.com">
                     </div>
                </div>

                <!-- Select -->
                 <div>
                     <label class="block text-sm font-medium text-gray-700 mb-2">Select Option</label>
                     <div class="relative">
                         <select class="block w-full pl-3 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-shadow outline-none text-gray-700 appearance-none bg-white">
                             <option>Corporate Plan</option>
                             <option>Freelancer</option>
                             <option>Student</option>
                         </select>
                         <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                     </div>
                </div>
            </div>
         </div>
    </section>

    <!-- Alert Components -->
    <section class="mb-20">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 pb-2 border-b border-gray-200">Alerts & Notifications</h2>
        <div class="space-y-4">
            <!-- Success -->
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700 font-medium">Operation Successful</p>
                    <p class="text-sm text-green-600 mt-1">Your changes have been saved to the database.</p>
                </div>
            </div>

            <!-- Info -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700 font-medium">Update Available</p>
                    <p class="text-sm text-blue-600 mt-1">A new version of the framework is available. Run composer update.</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
