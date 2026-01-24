@extends('layouts/master')

@section('main_content')
<div class="flex max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Sidebar Navigation -->
    <aside class="w-64 hidden lg:block pr-8 sticky top-24 h-[calc(100vh-120px)] overflow-y-auto custom-scrollbar">
        <h3 class="font-bold text-gray-900 mb-2 uppercase tracking-wider text-sm flex items-center">
            <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            Getting Started
        </h3>
        <ul class="space-y-1 mb-8 pl-6 border-l border-gray-100">
            <li><a href="#introduction" class="text-blue-600 font-medium hover:text-blue-700 block py-1 border-l-2 border-blue-600 -ml-[25px] pl-[23px]">Introduction</a></li>
            <li><a href="#installation" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Installation</a></li>
            <li><a href="#structure" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Directory Structure</a></li>
        </ul>

        <h3 class="font-bold text-gray-900 mb-2 uppercase tracking-wider text-sm flex items-center">
            <svg class="w-4 h-4 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            Architecture
        </h3>
        <ul class="space-y-1 mb-8 pl-6 border-l border-gray-100">
             <li><a href="#routing" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Routing</a></li>
            <li><a href="#controllers" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Controllers</a></li>
            <li><a href="#models" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Models (Domain)</a></li>
            <li><a href="#repositories" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Repositories</a></li>
            <li><a href="#services" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Services</a></li>
        </ul>

         <h3 class="font-bold text-gray-900 mb-2 uppercase tracking-wider text-sm flex items-center">
            <svg class="w-4 h-4 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
            Database
        </h3>
        <ul class="space-y-1 mb-8 pl-6 border-l border-gray-100">
            <li><a href="#database-config" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Configuration,</a></li>
             <li><a href="#migrations" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Migrations</a></li>
        </ul>

          <h3 class="font-bold text-gray-900 mb-2 uppercase tracking-wider text-sm flex items-center">
            <svg class="w-4 h-4 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            Core
        </h3>
        <ul class="space-y-1 mb-8 pl-6 border-l border-gray-100">
             <li><a href="#views" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Templating</a></li>
            <li><a href="#requests" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Requests & Responses</a></li>
            <li><a href="#helpers" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">Helpers</a></li>
            <li><a href="#cli" class="text-gray-600 hover:text-blue-600 block py-1 transition-colors">CLI Commands</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 min-w-0">
        
        <!-- Introduction -->
        <section id="introduction" class="mb-20">
            <h1 class="text-5xl font-extrabold text-gray-900 mb-6 tracking-tight">Documentation</h1>
            <p class="text-xl text-gray-500 leading-relaxed mb-8">
                Welcome to the official documentation for Med Framework. A highly structured, secure, and fast PHP framework designed to scale with your application.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                 <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-2xl border border-blue-100">
                    <h3 class="font-bold text-blue-900 text-lg mb-2">Modern Architecture</h3>
                    <p class="text-blue-700">Built on specialized Domain Driven Design principles (Application, Core, Domain, Infrastructure layers).</p>
                 </div>
                 <div class="bg-gradient-to-br from-purple-50 to-pink-50 p-6 rounded-2xl border border-purple-100">
                    <h3 class="font-bold text-purple-900 text-lg mb-2">Zero Dependencies</h3>
                    <p class="text-purple-700">Core system relies on native PHP 8+ features, ensuring blazing fast performance.</p>
                 </div>
            </div>
        </section>

        <!-- Installation -->
        <section id="installation" class="mb-20">
            <div class="flex items-center mb-6">
                 <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 mr-4 font-bold">1</div>
                <h2 class="text-3xl font-bold text-gray-900">Installation</h2>
            </div>
          
            <p class="text-gray-600 mb-6">Start by creating a new project via Composer. This will automatically set up the application structure for you.</p>
            
            <div class="bg-gray-900 rounded-xl overflow-hidden shadow-2xl mb-6">
                <div class="flex items-center px-4 py-2 bg-gray-800 border-b border-gray-700 space-x-2">
                    <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                    <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    <span class="ml-2 text-xs text-gray-400 font-mono">Terminal</span>
                </div>
                <pre class="p-6 text-sm text-gray-300 font-mono leading-relaxed">
<span class="text-green-400">$</span> composer create-project mohammed/php-boilerplate my-app
<span class="text-green-400">$</span> cd my-app
<span class="text-green-400">$</span> composer install
<span class="text-green-400">$</span> cp .env.example .env
<span class="text-green-400">$</span> php med run key:generate</pre>
            </div>
        </section>

        <!-- Structure -->
        <section id="structure" class="mb-20">
             <div class="flex items-center mb-6">
                 <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 mr-4 font-bold">2</div>
                <h2 class="text-3xl font-bold text-gray-900">Directory Structure</h2>
            </div>
            <p class="text-gray-600 mb-6">A clear separation of concerns ensures your codebase remains maintainable.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 hover:shadow-md transition-all">
                    <code class="text-blue-600 font-bold block mb-2">src/Application</code>
                    <p class="text-sm text-gray-600">Http entry points: Controllers, Middlewares, Routes, and request handling Services.</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 hover:shadow-md transition-all">
                    <code class="text-purple-600 font-bold block mb-2">src/Domain</code>
                    <p class="text-sm text-gray-600">The business logic heart. Models (Entities) reside here, representing your database tables.</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 hover:shadow-md transition-all">
                    <code class="text-green-600 font-bold block mb-2">src/Infrastructure</code>
                    <p class="text-sm text-gray-600">Low-level implementation details like Database connections, Migrations, and file storage.</p>
                </div>
                <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 hover:shadow-md transition-all">
                    <code class="text-pink-600 font-bold block mb-2">src/Core</code>
                    <p class="text-sm text-gray-600">Framework internal classes. You typically won't need to touch this.</p>
                </div>
            </div>
        </section>

        <hr class="border-gray-200 my-16">

        <!-- Routing -->
        <section id="routing" class="mb-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 group flex items-center">
                Routing
                <a href="#routing" class="opacity-0 group-hover:opacity-100 ml-2 text-blue-500 transition-opacity">#</a>
            </h2>
            <p class="text-gray-600 mb-6">
                Routes are the entry point of your application, defined in <code class="bg-gray-100 px-1 py-0.5 rounded text-sm text-pink-600 font-mono">src/Application/routes/web.php</code>.
            </p>

            <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 mb-6 shadow-md">
                <pre class="p-6 overflow-x-auto text-sm text-blue-100 font-mono">
<span class="text-purple-400">use</span> <span class="text-blue-300">App\Core\Router\Router</span>;
<span class="text-purple-400">use</span> <span class="text-blue-300">App\Application\Controllers\UserController</span>;

<span class="text-gray-500">// 1. Basic Closure Route</span>
<span class="text-blue-300">Router</span>::<span class="text-yellow-300">get</span>(<span class="text-green-300">'/hello'</span>, <span class="text-purple-400">function</span>() {
    <span class="text-purple-400">return</span> <span class="text-yellow-300">render</span>(<span class="text-green-300">'hello_world'</span>);
});

<span class="text-gray-500">// 2. Controller Route (Recommended)</span>
<span class="text-blue-300">Router</span>::<span class="text-yellow-300">get</span>(<span class="text-green-300">'/users'</span>, [<span class="text-blue-300">UserController</span>::<span class="text-purple-400">class</span>, <span class="text-green-300">'index'</span>]);
<span class="text-blue-300">Router</span>::<span class="text-yellow-300">post</span>(<span class="text-green-300">'/users/store'</span>, [<span class="text-blue-300">UserController</span>::<span class="text-purple-400">class</span>, <span class="text-green-300">'store'</span>]);</pre>
            </div>
        </section>

        <!-- Controllers -->
        <section id="controllers" class="mb-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 group flex items-center">
                Controllers
                <a href="#controllers" class="opacity-0 group-hover:opacity-100 ml-2 text-blue-500 transition-opacity">#</a>
            </h2>
            <p class="text-gray-600 mb-6">
                Controllers handle incoming requests. Create them in <code class="bg-gray-100 px-1 py-0.5 rounded text-sm text-pink-600 font-mono">src/Application/Controllers</code>.
            </p>

             <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <strong class="text-blue-800">CLI Tip:</strong>
                <code class="ml-2 bg-white px-2 py-1 rounded border border-blue-200 text-sm font-mono text-gray-700">php med make:controller UserController</code>
            </div>

            <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 mb-6 shadow-md">
                <pre class="p-6 overflow-x-auto text-sm text-blue-100 font-mono">
<span class="text-purple-400">namespace</span> <span class="text-blue-300">App\Application\Controllers</span>;

<span class="text-purple-400">use</span> <span class="text-blue-300">App\Core\Http\Request</span>;

<span class="text-purple-400">class</span> <span class="text-yellow-300">UserController</span> 
{
    <span class="text-purple-400">public function</span> <span class="text-blue-300">index</span>()
    {
        <span class="text-purple-400">return</span> <span class="text-yellow-300">view</span>(<span class="text-green-300">'users.index'</span>, [<span class="text-green-300">'users'</span> => []]);
    }

    <span class="text-purple-400">public function</span> <span class="text-blue-300">store</span>()
    {
        <span class="text-purple-400">$name</span> = <span class="text-blue-300">Request</span>::<span class="text-yellow-300">input</span>(<span class="text-green-300">'name'</span>);
        <span class="text-gray-500">// Save logic...</span>
    }
}</pre>
            </div>
        </section>

         <!-- Views -->
        <section id="views" class="mb-20">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 group flex items-center">
                Templating (Blade)
                <a href="#views" class="opacity-0 group-hover:opacity-100 ml-2 text-blue-500 transition-opacity">#</a>
            </h2>
             <p class="text-gray-600 mb-6">
                Med Framework includes a powerful Blade-compatible engine. Files must use the <code class="bg-gray-100 px-1 py-0.5 rounded text-sm text-pink-600 font-mono">.med.php</code> extension.
            </p>

            <h3 class="text-xl font-bold text-gray-900 mb-4">Master Layout</h3>
             <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 mb-6 shadow-md">
                 <div class="flex items-center px-4 py-2 bg-gray-900 border-b border-gray-700">
                    <span class="text-xs text-gray-400">views/layouts/master.med.php</span>
                </div>
                <pre class="p-6 overflow-x-auto text-sm text-blue-100 font-mono">
&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;body&gt;
    <span class="text-purple-400">&#64;include</span>(<span class="text-green-300">'partials/nav'</span>)
    
    &lt;div class="container"&gt;
        <span class="text-purple-400">&#64;yield</span>(<span class="text-green-300">'content'</span>)
    &lt;/div&gt;

    &lt;script src="&amp;#123;&amp;#123; <span class="text-yellow-300">asset</span>(<span class="text-green-300">'js/app.js'</span>) &amp;#125;&amp;#125;"&gt;&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;</pre>
            </div>

            <h3 class="text-xl font-bold text-gray-900 mb-4">Child Page</h3>
            <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 mb-6 shadow-md">
                 <div class="flex items-center px-4 py-2 bg-gray-900 border-b border-gray-700">
                    <span class="text-xs text-gray-400">views/home.med.php</span>
                </div>
                 <pre class="p-6 overflow-x-auto text-sm text-blue-100 font-mono">
<span class="text-purple-400">&#64;extends</span>(<span class="text-green-300">'layouts/master'</span>)

<span class="text-purple-400">&#64;section</span>(<span class="text-green-300">'content'</span>)
    &lt;h1&gt;Welcome, &amp;#123;&amp;#123; <span class="text-blue-300">$user</span> &amp;#125;&amp;#125;!&lt;/h1&gt;
    
    <span class="text-purple-400">&#64;if</span>(<span class="text-blue-300">$isAdmin</span>)
        &lt;button&gt;Admin Panel&lt;/button&gt;
    <span class="text-purple-400">&#64;endif</span>
<span class="text-purple-400">&#64;endsection</span></pre>
            </div>
        </section>

        <!-- CLI -->
        <section id="cli" class="mb-20">
             <h2 class="text-3xl font-bold text-gray-900 mb-6 group flex items-center">
                CLI Commands
                <a href="#cli" class="opacity-0 group-hover:opacity-100 ml-2 text-blue-500 transition-opacity">#</a>
            </h2>
            <p class="text-gray-600 mb-6">
                Automate your workflow with the built-in <code class="bg-gray-900 px-2 py-0.5 rounded text-sm text-white font-mono">med</code> CLI tool.
            </p>

            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg mb-8">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Command</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                         <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-mono text-purple-600 sm:pl-6">php med serve</td>
                            <td class="px-3 py-4 text-sm text-gray-500">Starts the local development server.</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-mono text-purple-600 sm:pl-6">php med make:controller</td>
                            <td class="px-3 py-4 text-sm text-gray-500">Create a new Controller in Application layer.</td>
                        </tr>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-mono text-purple-600 sm:pl-6">php med make:model</td>
                            <td class="px-3 py-4 text-sm text-gray-500">Create a new Model in Domain layer.</td>
                        </tr>
                        <tr>
                             <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-mono text-purple-600 sm:pl-6">php med make:migration</td>
                            <td class="px-3 py-4 text-sm text-gray-500">Create a new database migration file.</td>
                        </tr>
                         <tr>
                             <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-mono text-purple-600 sm:pl-6">php med migrate</td>
                            <td class="px-3 py-4 text-sm text-gray-500">Run pending database migrations.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>
@endsection
