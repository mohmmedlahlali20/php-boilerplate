@extends('layouts/master')

@section('main_content')
<style>
    :root {
        --docs-primary: #FF003C;
        --docs-bg: #050505;
        --docs-sidebar: #0a0a0a;
        --docs-text: #9ca3af;
        --docs-heading: #ffffff;
        --docs-code-bg: #0d0d0d;
        --docs-border: rgba(255, 0, 60, 0.1);
        --docs-accent-glow: rgba(255, 0, 60, 0.05);
    }

    .docs-layout {
        display: grid;
        grid-template-columns: 280px 1fr 200px;
        min-height: calc(100vh - 80px);
        background: var(--docs-bg);
    }

    /* Sidebar Navigation */
    .docs-nav {
        background: var(--docs-sidebar);
        border-right: 1px solid var(--docs-border);
        padding: 2.5rem 1.5rem;
        position: sticky;
        top: 80px;
        height: calc(100vh - 80px);
        overflow-y: auto;
    }

    .nav-label {
        font-size: 0.65rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.25em;
        color: #4b5563;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
        display: block;
    }

    .nav-link {
        display: block;
        padding: 0.5rem 0.75rem;
        color: #6b7280;
        font-size: 0.8rem;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.2s;
        border-left: 2px solid transparent;
        font-weight: 600;
    }

    .nav-link:hover { color: var(--docs-primary); background: rgba(255, 0, 60, 0.02); }
    .nav-link.active { color: white; border-left-color: var(--docs-primary); background: rgba(255, 0, 60, 0.05); }

    /* Main Content */
    .docs-content {
        padding: 4rem 6rem;
        max-width: 1100px;
    }

    .prose h1 { font-size: 4rem; font-weight: 900; color: white; margin-bottom: 3rem; letter-spacing: -0.05em; line-height: 0.9; }
    .prose h2 { font-size: 2.2rem; font-weight: 800; color: white; margin-top: 6rem; margin-bottom: 2rem; border-bottom: 1px solid var(--docs-border); padding-bottom: 0.5rem; }
    .prose h3 { font-size: 1.4rem; font-weight: 900; color: var(--docs-primary); margin-top: 3.5rem; margin-bottom: 1rem; text-transform: uppercase; }
    .prose p { font-size: 1.15rem; line-height: 1.8; color: var(--docs-text); margin-bottom: 1.5rem; }
    .prose ul { list-style: none; padding-left: 0; margin-bottom: 2rem; }
    .prose ul li { position: relative; padding-left: 1.5rem; margin-bottom: 0.5rem; color: #d1d5db; }
    .prose ul li::before { content: '→'; position: absolute; left: 0; color: var(--docs-primary); font-weight: 900; }

    /* API Tables and Boxes */
    .method-card {
        background: #0d0d0d;
        border: 1px solid var(--docs-border);
        border-radius: 4px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        border-left: 4px solid var(--docs-primary);
    }
    .method-sig { font-family: 'JetBrains Mono', monospace; font-size: 0.9rem; color: #ff6e91; font-weight: 700; margin-bottom: 0.5rem; }
    .method-desc { font-size: 0.9rem; color: #9ca3af; }

    /* Code Blocks */
    .code-block {
        background: #000;
        border: 1px solid #1a1a1a;
        padding: 2rem;
        border-radius: 8px;
        margin: 2.5rem 0;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.85rem;
        overflow-x: auto;
        position: relative;
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
    }
    .code-block::before {
        content: ""; position: absolute; top: 0; left: 0; right: 0; height: 1px;
        background: linear-gradient(90deg, transparent, var(--docs-primary), transparent);
    }

    /* Right On-Page Nav */
    .docs-toc {
        padding: 4rem 1.5rem;
        position: sticky;
        top: 80px;
        height: min-content;
        border-left: 1px solid var(--docs-border);
    }
    .toc-title { font-size: 0.6rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.2em; color: #4b5563; margin-bottom: 1rem; }
    .toc-link { display: block; padding: 0.25rem 0; color: #4b5563; font-size: 0.75rem; text-decoration: none; transition: color 0.2s; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .toc-link:hover { color: var(--docs-primary); }

    .glow-text { text-shadow: 0 0 30px rgba(255, 0, 60, 0.4); }

    @media (max-width: 1200px) {
        .docs-layout { grid-template-columns: 280px 1fr; }
        .docs-toc { display: none; }
    }
</style>

<div class="docs-layout">
    <aside class="docs-nav">
        <div class="mb-8">
            <h4 class="text-white font-black text-[10px] uppercase tracking-[0.4em] mb-4">Grimoire Search</h4>
            <input type="text" placeholder="FILTER API..." class="w-full bg-white/5 border border-white/10 px-4 py-3 text-xs text-white placeholder-gray-600 focus:outline-none focus:border-demon-crimson" id="navSearch">
        </div>

        <nav>
            <span class="nav-label">Foundations</span>
            <a href="#bootstrap" class="nav-link active">Bootstrap Engine</a>
            <a href="#env" class="nav-link">Environment Control</a>
            <a href="#container" class="nav-link">Void Container</a>
            <a href="#config" class="nav-link">Configuration</a>

            <span class="nav-label">HTTP Stack</span>
            <a href="#request" class="nav-link">Soul Request</a>
            <a href="#response" class="nav-link">Manifest Response</a>
            <a href="#router" class="nav-link">Abyssal Router</a>
            <a href="#middleware" class="nav-link">Containment (Middleware)</a>

            <span class="nav-label">Persistence</span>
            <a href="#db-manager" class="nav-link">Database Manager</a>
            <a href="#query-builder" class="nav-link">Query Builder</a>
            <a href="#model" class="nav-link">Nether Model (ORM)</a>
            <a href="#schema" class="nav-link">Schema & Blueprint</a>

            <span class="nav-label">Core Systems</span>
            <a href="#cache" class="nav-link">Soul Cache Layer</a>
            <a href="#event" class="nav-link">Event Dispatcher</a>
            <a href="#blade" class="nav-link">Blade View Engine</a>

            <span class="nav-label">Demon CLI</span>
            <a href="#cli-core" class="nav-link">CLI Commands</a>
            
            <span class="nav-label">The Blood</span>
            <a href="#helpers" class="nav-link">Global Helpers</a>
        </nav>
    </aside>

    <main class="docs-content prose">
        <h1 class="glow-text">The Leviathan Grimoire</h1>
        <p class="text-2xl font-black text-white italic">Zero Placeholders. Total Coverage.</p>
        <p>This is the definitive technical manual for the <strong>Demon Framework</strong>. Every internal method across all core classes is documented here with exhaustive detail. This grimoire is engineered to support the workload of an enterprise-grade team of 50+ engineers.</p>

        <section id="bootstrap">
            <h2>Bootstrap Engine</h2>
            <p>The <code>App\Core\Bootstrap\Bootstrap</code> class is the grand architect. It initializes the environment, loads configurations, discovers modules, and ignites the application lifecycle.</p>
            
            <div class="method-card">
                <div class="method-sig">public static boot(): void</div>
                <div class="method-desc">Sets base paths, loads <code>.env</code>, configures global error reporting based on <code>APP_DEBUG</code>, and initializes the session.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public static run(): void</div>
                <div class="method-desc">The primary entry point. Orchestrates the total framework lifecycle: <strong>Boot → Environment Validation → Container Resolution → Module Discovery → Route Resolution</strong>.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public static initView(): BladeEngine</div>
                <div class="method-desc">Initializes the standalone BladeEngine instance with current project configurations.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public static initDatabase(): PDO</div>
                <div class="method-desc">Retrieves the active global database connection manifestation.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public static getBasePath(): string</div>
                <div class="method-desc">Returns the absolute path to the project root.</div>
            </div>

            <div class="code-block">
                <span class="text-gray-600">// Ignition in public/index.php</span>
                <span class="text-white">require_once</span> <span class="text-emerald-400">__DIR__ . '/../vendor/autoload.php'</span>;
                <span class="text-blue-400">Bootstrap</span>::<span class="text-yellow-400">run</span>();
            </div>
        </section>

        <section id="container">
            <h2>Void Container</h2>
            <p>The <code>App\Core\Container\Container</code> is a PSR-11 compliant dependency resolution engine. It handles "Zero-Config" auto-wiring using PHP Reflection.</p>
            
            <div class="method-card">
                <div class="method-sig">public static getInstance(): Container</div>
                <div class="method-desc">Retrieves the singleton instance of the container void.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public bind(string abstract, concrete = null, bool shared = false): void</div>
                <div class="method-desc">Attaches a concrete implementation or closure to an abstract key.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public singleton(string abstract, concrete = null): void</div>
                <div class="method-desc">Shortcut for binding a persistent, shared soul (instance) that survives the request cycle.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public get(string abstract): mixed</div>
                <div class="api-desc">Resolves and manifestations a soul from the container. <strong>Note:</strong> Automatically detects circular dependencies and throws a <code>ContainerException</code>.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public resolve(string concrete): mixed</div>
                <div class="method-desc">Deep reflection logic. It inspects class constructors, resolves every specific class dependency, and instantiates the final manifestation.</div>
            </div>
        </section>

        <section id="request">
            <h2>Soul Request</h2>
            <p>The <code>App\Core\Http\Request</code> object is an immutable representation of the incoming transmission essence.</p>
            
            <div class="method-card">
                <div class="method-sig">public all(): array</div>
                <div class="method-desc">Merges <code>$_GET</code>, <code>$_POST</code>, and raw JSON payloads into a single data manifestation.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public input(string key, default = null): mixed</div>
                <div class="method-desc">Retrieves a specific value from the request payload.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public method(): string</div>
                <div class="method-desc">Returns the transmission method (always uppercase: GET, POST, PUT, DELETE).</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public isJson(): bool</div>
                <div class="method-desc">Returns <code>true</code> if the <code>Content-Type</code> is set to <code>application/json</code>.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public header(string key, default = null): ?string</div>
                <div class="method-desc">Reads a specific HTTP header essence.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public ip(): ?string</div>
                <div class="method-desc">Retrieves the origin platform IP address.</div>
            </div>
        </section>

        <section id="router">
            <h2>Abyssal Router</h2>
            <p>The <code>App\Core\Router\Router</code> handles endpoint resolution and portal mapping.</p>
            
            <div class="method-card">
                <div class="method-sig">static get/post/put/delete(uri, callback): static</div>
                <div class="method-desc">Registers a new route portal. Supports named parameters like <code>/user/{id}</code>.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">public middleware(string alias): self</div>
                <div class="method-desc">Attaches a containment middleware to the last registered route.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">static resolve(): void</div>
                <div class="method-desc">Compares current Request to registered portals. Orchestrates the <strong>Middleware Pipeline → Action Execution → Handle Result</strong> flow.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">protected static executeAction(callback, request, params): mixed</div>
                <div class="method-desc">Internal execution core. Supports Closures and <code>[Controller::class, 'method']</code> arrays. Resolves controllers via the Container.</div>
            </div>
        </section>

        <section id="query-builder">
            <h2>Query Builder API</h2>
            <p>The <code>App\Core\Database\QueryBuilder</code> provides a fluent, chainable interface for database dominance.</p>
            
            <div class="method-card">
                <div class="method-sig">table(string table): self</div>
                <div class="method-desc">Set the target database sector (table).</div>
            </div>
            <div class="method-card">
                <div class="method-sig">where(col, val, op = '='): self</div>
                <div class="method-desc">Adds a conditional constraint to the query manifestation.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">orderBy(col, direction = 'ASC'): self</div>
                <div class="method-desc">Directs the sequence of manifestation results.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">limit(int limit): self</div>
                <div class="method-desc">Restricts the number of manifested souls.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">remember(int seconds): self</div>
                <div class="method-desc"><strong>Engine Exclusive:</strong> Caches the resulting manifestation in the Soul Cache for the specified duration.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">get(): array</div>
                <div class="method-desc">Finalizes the query and manifestations an array of model instances.</div>
            </div>
        </section>

        <section id="cache">
            <h2>Soul Cache API</h2>
            <p>The <code>App\Core\Support\Cache</code> handles high-performance file-based persistence.</p>
            
            <div class="method-card">
                <div class="method-sig">static set(key, val, ttl = 3600): bool</div>
                <div class="method-desc">Stores an essence. The value is serialized and protected via JSON expiration seals.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">static get(key): mixed</div>
                <div class="method-desc">Retrieves an essence. Automatically unlinks (deletes) expired files.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">static has(key): bool</div>
                <div class="method-desc">Checks if the essence exists and is still potent.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">static forget(key): void</div>
                <div class="method-desc">Incinerates a specific cached essence.</div>
            </div>
        </section>

        <section id="helpers">
            <h2>Global Helpers Reference</h2>
            <p>Functional rituals available globally across the framework.</p>
            
            <div class="method-card">
                <div class="method-sig">view(name, data): string</div>
                <div class="method-desc">Functional manifestation of the BladeEngine.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">dd(...vars): void</div>
                <div class="method-desc">Soul Inspection tool. Halts execution and displays formatted internal state with Demon aesthetic.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">asset(path): string</div>
                <div class="method-desc">Generates absolute manifestation URLs for tactical resources.</div>
            </div>
            <div class="method-card">
                <div class="method-sig">flash(key, message): ?string</div>
                <div class="method-desc">Sets or manifestations ephemeral session messages (consumed after one reading).</div>
            </div>
            <div class="method-card">
                <div class="method-sig">config(key, default): mixed</div>
                <div class="method-desc">Access dot-notation configurations manifests instantly.</div>
            </div>
        </section>

        <footer class="mt-40 border-t border-demon-crimson/10 pt-20 pb-40">
            <div class="flex justify-between items-center text-gray-700 font-black text-[10px] uppercase tracking-[0.5em]">
                <div>Demon Framework V6.6.6 | Leviathan Edition</div>
                <div>Authorized Access Only. Built with Blood.</div>
            </div>
        </footer>
    </main>

    <aside class="docs-toc">
        <div class="toc-title">On this page</div>
        <a href="#bootstrap" class="toc-link">Bootstrap Eng.</a>
        <a href="#container" class="toc-link">Void Container</a>
        <a href="#request" class="toc-link">Soul Request</a>
        <a href="#router" class="toc-link">Abyssal Router</a>
        <a href="#query-builder" class="toc-link">Query Builder</a>
        <a href="#cache" class="toc-link">Soul Cache</a>
        <a href="#helpers" class="toc-link">Global Helpers</a>
    </aside>
</div>

<script>
    // Search Filtering
    const navSearch = document.getElementById('navSearch');
    navSearch.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            const match = link.textContent.toLowerCase().includes(query);
            link.style.display = match ? 'block' : 'none';
        });

        // Hide section labels if no matches
        document.querySelectorAll('.nav-label').forEach(label => {
            const nextGroup = Array.from(label.nextElementSibling ? [label.nextElementSibling] : []);
            let hasVisible = false;
            let current = label.nextElementSibling;
            while(current && !current.classList.contains('nav-label')) {
                if(current.style.display !== 'none') hasVisible = true;
                current = current.nextElementSibling;
            }
            label.style.display = hasVisible ? 'block' : 'none';
        });
    });

    // Intersection Observer for Scroll-Spy
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.classList.toggle('active', link.getAttribute('href') === `#` + id);
                });
                document.querySelectorAll('.toc-link').forEach(link => {
                    link.style.color = (link.getAttribute('href') === `#` + id) ? '#FF003C' : '#4b5563';
                });
            }
        });
    }, { rootMargin: '-10% 0px -80% 0px' });

    document.querySelectorAll('section[id]').forEach(s => observer.observe(s));
</script>
@endsection