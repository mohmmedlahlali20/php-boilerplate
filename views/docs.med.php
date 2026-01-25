@extends('layouts/master')

@section('main_content')
<style>
    :root {
        --docs-primary: #4F46E5;
        --docs-bg: #F9FAFB;
        --docs-sidebar: #FFFFFF;
        --docs-text: #1F2937;
        --docs-code-bg: #111827;
    }

    .docs-container {
        display: grid;
        grid-template-columns: 280px 1fr;
        min-height: calc(100vh - 64px);
        background: var(--docs-bg);
    }

    .docs-sidebar {
        background: var(--docs-sidebar);
        border-right: 1px solid #E5E7EB;
        padding: 2rem 1.5rem;
        position: sticky;
        top: 64px;
        height: calc(100vh - 64px);
        overflow-y: auto;
        z-index: 10;
    }

    .docs-content {
        padding: 4rem 5rem;
        max-width: 1000px;
        line-height: 1.6;
        color: var(--docs-text);
    }

    .search-box {
        position: relative;
        margin-bottom: 2rem;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid #E5E7EB;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        transition: all 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--docs-primary);
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .nav-group {
        margin-bottom: 2rem;
    }

    .nav-title {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6B7280;
        margin-bottom: 0.75rem;
    }

    .nav-link {
        display: block;
        padding: 0.5rem 0.75rem;
        color: #4B5563;
        font-size: 0.9375rem;
        border-radius: 0.375rem;
        text-decoration: none;
        transition: all 0.2s;
        margin-bottom: 2px;
    }

    .nav-link:hover {
        background: rgba(79, 70, 229, 0.05);
        color: var(--docs-primary);
    }

    .nav-link.active {
        background: rgba(79, 70, 229, 0.1);
        color: var(--docs-primary);
        font-weight: 600;
    }

    .prose h1 { font-size: 3rem; font-weight: 800; color: #111827; margin-bottom: 2rem; letter-spacing: -0.025em; }
    .prose h2 { font-size: 2rem; font-weight: 700; color: #111827; margin-top: 4rem; margin-bottom: 1.5rem; border-bottom: 1px solid #E5E7EB; padding-bottom: 0.75rem; }
    .prose h3 { font-size: 1.5rem; font-weight: 600; color: #111827; margin-top: 2.5rem; margin-bottom: 1rem; }
    .prose p { margin-bottom: 1.5rem; font-size: 1.125rem; color: #4B5563; }

    .code-block {
        background: var(--docs-code-bg);
        border-radius: 1rem;
        padding: 2rem;
        margin: 2rem 0;
        position: relative;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .code-lang-tag {
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        color: #6B7280;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .alert {
        padding: 1.5rem;
        border-radius: 1rem;
        margin: 2rem 0;
        display: flex;
        gap: 1.25rem;
        line-height: 1.5;
    }

    .alert-info { background: #EEF2FF; border: 1px solid #C7D2FE; color: #3730A3; }
    .alert-warning { background: #FFFBEB; border: 1px solid #FDE68A; color: #92400E; }
    .alert-icon { width: 1.5rem; h-height: 1.5rem; flex-shrink: 0; }

    .feature-card {
        background: white;
        padding: 1.5rem;
        border-radius: 1rem;
        border: 1px solid #E5E7EB;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        border-color: var(--docs-primary);
    }
</style>

<div class="docs-container">
    <aside class="docs-sidebar custom-scrollbar">
        <div class="search-box">
             <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" placeholder="Quick search..." class="search-input" id="docsSearch">
        </div>

        <nav id="docsNav">
            <div class="nav-group">
                <div class="nav-title">Engine Fundamentals</div>
                <a href="#introduction" class="nav-link active">Documentation Home</a>
                <a href="#architecture" class="nav-link">Architecture Deep Dive</a>
                <a href="#lifecycle" class="nav-link">Request Lifecycle</a>
            </div>

            <div class="nav-group">
                <div class="nav-title">Core Systems</div>
                <a href="#container" class="nav-link">IoC Service Container</a>
                <a href="#providers" class="nav-link">Service Providers</a>
                <a href="#config" class="nav-link">Centralized Config</a>
                <a href="#routing" class="nav-link">Routing & Facades</a>
            </div>

            <div class="nav-group">
                <div class="nav-title">Data Architecture</div>
                <a href="#orm" class="nav-link">Active Record ORM</a>
                <a href="#migrations" class="nav-link">Migrations & Blueprints</a>
            </div>

            <div class="nav-group">
                <div class="nav-title">Staff Engineering</div>
                <a href="#exceptions" class="nav-link">Exception Management</a>
                <a href="#observability" class="nav-link">Logging & Monitioring</a>
                <a href="#security" class="nav-link">Security Protocols</a>
            </div>
        </nav>
    </aside>

    <main class="docs-content prose">
        <section id="introduction">
            <h1>Engineering Documentation</h1>
            <p class="text-xl">Welcome to the <strong>Med Framework</strong> ecosystem. This platform is engineered for high-performance enterprise applications, emphasizing strict architectural standards and unparalleled developer experience.</p>
            
            <div class="alert alert-info">
                 <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                 <div>
                    <strong>Philosophy of Excellence:</strong> We believe in explicit code over implicit magic. Every component is strictly typed, observable, and designed for unit testability.
                 </div>
            </div>
        </section>

        <section id="architecture">
            <h2>Architecture Deep Dive</h2>
            <p>Our architecture utilizes a layered Domain-Driven approach. This ensures that infrastructure concerns are decoupled from high-level business logic.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-10">
                <div class="feature-card">
                    <div class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="!mt-0 text-lg">Core Layer</h3>
                    <p class="text-sm text-gray-500">Immutable framework logic. Zero dependencies on external libraries.</p>
                </div>
                <div class="feature-card">
                    <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path></svg>
                    </div>
                    <h3 class="!mt-0 text-lg">Domain Layer</h3>
                    <p class="text-sm text-gray-500">The business heart. Contains Models and rich service logic.</p>
                </div>
                <div class="feature-card">
                    <div class="w-10 h-10 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="!mt-0 text-lg">App Layer</h3>
                    <p class="text-sm text-gray-500">Entry points: Controllers, Middleware, and API definitions.</p>
                </div>
            </div>
        </section>

        <section id="lifecycle">
            <h2>Request Lifecycle</h2>
            <p>Understanding the entry point and execution flow is critical for extending the framework. The lifecycle follows a predictable path from the entry script to the final response.</p>
            <div class="bg-indigo-50 border border-indigo-100 p-6 rounded-xl my-8">
                <ol class="space-y-4 text-indigo-900 font-medium">
                    <li>1. <code class="bg-white px-2 py-0.5 rounded shadow-sm text-indigo-600">index.php</code> serves as the HTTP entry point.</li>
                    <li>2. <code class="bg-white px-2 py-0.5 rounded shadow-sm text-indigo-600">Bootstrap::run()</code> initializes the core engine.</li>
                    <li>3. Service Providers are registered and booted into the IoC container.</li>
                    <li>4. Routes are loaded and matched via the <code class="bg-white px-2 py-0.5 rounded shadow-sm text-indigo-600">Router</code>.</li>
                    <li>5. Target Controller executes and returns a <code class="bg-white px-2 py-0.5 rounded shadow-sm text-indigo-600">Response</code>.</li>
                </ol>
            </div>
        </section>

        <section id="providers">
            <h2>Service Providers</h2>
            <p>Providers are the bootstrap mechanism. They allow you to bind services and perform complex initializations before the request hits the router.</p>
            <div class="code-block">
                <div class="code-lang-tag">AppServiceProvider.php</div>
                <pre class="text-gray-300 font-mono text-sm leading-relaxed">
<span class="text-purple-400">public function</span> <span class="text-blue-300">boot</span>(): <span class="text-purple-400">void</span>
{
    <span class="text-gray-500">// Bootstrapping logic (e.g., custom configuration)</span>
    <span class="text-blue-300">View</span>::<span class="text-yellow-300">share</span>(<span class="text-green-300">'app_version'</span>, <span class="text-green-300">'v2.4.0'</span>);
}</pre>
            </div>
        </section>

        <section id="config">
            <h2>Centralized Configuration</h2>
            <p>Manage application settings via strictly typed PHP arrays in the <code class="bg-gray-100 px-1 py-0.5 rounded text-sm text-indigo-600 font-mono">config/*.php</code> directory.</p>
            <div class="code-block">
                <div class="code-lang-tag">Usage</div>
                <pre class="text-gray-300 font-mono text-sm leading-relaxed">
<span class="text-gray-500">// Accessible anywhere via the helper</span>
<span class="text-purple-400">$dbHost</span> = <span class="text-yellow-300">config</span>(<span class="text-green-300">'database.connections.mysql.host'</span>);</pre>
            </div>
        </section>

        <section id="routing">
            <h2>Routing & Facades</h2>
            <p>Defining entry points is expressive and clean. Facades provide a static proxy to underlying container services.</p>
            <div class="code-block">
                <div class="code-lang-tag">web.php</div>
                <pre class="text-gray-300 font-mono text-sm leading-relaxed">
<span class="text-blue-300">Route</span>::<span class="text-yellow-300">get</span>(<span class="text-green-300">'/api/user/{id}'</span>, [<span class="text-blue-300">UserController</span>::<span class="text-purple-400">class</span>, <span class="text-green-300">'show'</span>])
      -><span class="text-yellow-300">middleware</span>(<span class="text-green-300">'auth:api'</span>);</pre>
            </div>
        </section>

        <section id="orm">
            <h2>Active Record ORM</h2>
            <p>Our ORM provides an expressive query builder while maintaining a small memory footprint. Every model interaction is strictly typed and protected against SQL injection.</p>
            
            <div class="code-block">
                <div class="code-header"><button class="copy-btn">Copy</button></div>
                <pre class="text-gray-300 font-mono text-sm leading-relaxed">
<span class="text-gray-500">// Fluent, readable, and staff-grade</span>
<span class="text-blue-300">User</span>::<span class="text-yellow-300">where</span>(<span class="text-green-300">'email'</span>, <span class="text-blue-300">$email</span>)
    -><span class="text-yellow-300">orderBy</span>(<span class="text-green-300">'created_at'</span>, <span class="text-green-300">'DESC'</span>)
    -><span class="text-yellow-300">first</span>();</pre>
            </div>
        </section>

        <section id="migrations">
            <h2>Migrations & Blueprints</h2>
            <p>Version control for your database. We use a fluent builder to define schema changes programmatically.</p>
            <div class="code-block">
                <div class="code-lang-tag">Migration Example</div>
                <pre class="text-gray-300 font-mono text-sm leading-relaxed">
<span class="text-blue-300">Schema</span>::<span class="text-yellow-300">create</span>(<span class="text-green-300">'vouchers'</span>, <span class="text-purple-400">function</span> (<span class="text-blue-300">Blueprint $table</span>) {
    <span class="text-blue-300">$table</span>-><span class="text-yellow-300">id</span>();
    <span class="text-blue-300">$table</span>-><span class="text-yellow-300">string</span>(<span class="text-green-300">'code'</span>)-><span class="text-yellow-300">unique</span>();
    <span class="text-blue-300">$table</span>-><span class="text-yellow-300">decimal</span>(<span class="text-green-300">'discount'</span>, 8, 2);
    <span class="text-blue-300">$table</span>-><span class="text-yellow-300">timestamps</span>();
});</pre>
            </div>
        </section>

        <section id="exceptions">
            <h2>Exception Management</h2>
            <p>Our centralized error handling ensures that no crash goes unlogged. Use the custom hierarchy to provide context-aware failures.</p>
            
            <div class="code-block">
                <div class="code-lang-tag">Exception Hierarchy</div>
                <pre class="text-gray-300 font-mono text-sm leading-relaxed">
<span class="text-purple-400">try</span> {
    <span class="text-gray-500">// Business logic</span>
} <span class="text-purple-400">catch</span> (<span class="text-blue-300">ConfigurationException $e</span>) {
    <span class="text-blue-300">Log</span>::<span class="text-yellow-300">error</span>(<span class="text-blue-300">$e</span>-><span class="text-yellow-300">getMessage</span>());
}</pre>
            </div>

            <div class="alert alert-warning">
                 <svg class="alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                 <div>
                    <strong>Staff Engineering Note:</strong> Centralized catch blocks in <code>Bootstrap::run()</code> guarantee that production users never see a raw stack trace.
                 </div>
            </div>
        </section>

        <section id="observability">
            <h2>Logging & Observability</h2>
            <p>Every framework event can be recorded with structured context. This is essential for post-mortem analysis in staff-level deployments.</p>
            
            <div class="code-block">
                <div class="code-lang-tag">Log Facade</div>
                <pre class="text-gray-300 font-mono text-sm leading-relaxed">
<span class="text-blue-300">Log</span>::<span class="text-yellow-300">info</span>(<span class="text-green-300">'User Login Attempt'</span>, [
    <span class="text-green-300">'ip'</span> => <span class="text-blue-300">$request</span>-><span class="text-yellow-300">ip</span>(),
    <span class="text-green-300">'email'</span> => <span class="text-blue-300">$email</span>
]);</pre>
            </div>
        </section>

        <section id="security">
            <h2>Security Protocols</h2>
            <p>Hardened by default. We implement CSRF protection, secure session management, and automated SQL injection mitigation via PDO prepared statements.</p>
            <div class="bg-red-50 border border-red-100 p-6 rounded-xl my-8">
                <h4 class="text-red-900 font-bold mb-2 uppercase text-xs tracking-widest">Security Checklist</h4>
                <ul class="text-red-800 space-y-2 text-sm font-medium">
                    <li>&check; Use <code>@CSRF</code> on all POST forms.</li>
                    <li>&check; Set <code>APP_DEBUG=false</code> in production.</li>
                    <li>&check; Sanitize all user-input displays via <code>&lcub;&lcub; &rcub;&rcub;</code>.</li>
                </ul>
            </div>
        </section>

        <footer class="mt-24 py-10 border-t border-gray-200">
            <div class="flex justify-between items-center text-gray-400 text-sm">
                <div>Framework Version 10.4.2 (LRT)</div>
                <div>&copy; 2026 Engineering Org. All rights reserved.</div>
            </div>
        </footer>
    </main>
</div>

<script>
    // Search logic with highlighting
    const docsSearch = document.getElementById('docsSearch');
    docsSearch.addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase();
        const links = document.querySelectorAll('.nav-link');
        
        links.forEach(link => {
            const match = link.textContent.toLowerCase().includes(query);
            link.style.display = match ? 'block' : 'none';
        });
    });

    // Intersection Observer for scroll-spy effect
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.toggle('active', link.getAttribute('href') === `#${id}`);
                });
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('section[id]').forEach((section) => {
        observer.observe(section);
    });

    // Smooth scroll for nav links
    document.querySelectorAll('.nav-link').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 100,
                    behavior: 'smooth'
                });
                
                // Update active state immediately
                document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
                this.classList.add('active');
                
                // Update URL without jump
                history.pushState(null, null, '#' + targetId);
            }
        });
    });
</script>
@endsection
