<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Demon Framework' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Space Grotesk"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        demon: {
                            obsidian: '#050505',
                            charcoal: '#111111',
                            crimson: '#FF003C',
                            blood: '#8B0000',
                        }
                    },
                    backgroundImage: {
                        'noise': "url('https://grainy-gradients.vercel.app/noise.svg')",
                    },
                    animation: {
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        glow: {
                            '0%': { 'box-shadow': '0 0 5px #FF003C, 0 0 10px #FF003C' },
                            '100%': { 'box-shadow': '0 0 20px #FF003C, 0 0 30px #FF003C' },
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        @layer base {
            body {
                @apply bg-demon-obsidian text-gray-300 selection:bg-demon-crimson selection:text-white;
            }
        }

        .demon-glass {
            background: rgba(17, 17, 17, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 0, 60, 0.1);
        }

        .demon-glass-sharp {
            background: rgba(5, 5, 5, 0.8);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 0, 60, 0.3);
        }

        .demon-glow-text {
            text-shadow: 0 0 10px rgba(255, 0, 60, 0.5), 0 0 20px rgba(255, 0, 60, 0.3);
        }

        .demon-crimson-border {
            border: 1px solid #FF003C;
            box-shadow: 0 0 15px rgba(255, 0, 60, 0.4);
        }

        .demon-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .demon-scrollbar::-webkit-scrollbar-track {
            background: #050505;
        }
        .demon-scrollbar::-webkit-scrollbar-thumb {
            background: #222;
            border-radius: 3px;
        }
        .demon-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #FF003C;
        }

        .aura-effect {
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 0, 60, 0.15) 0%, rgba(5, 5, 5, 0) 70%);
            filter: blur(100px);
            pointer-events: none;
            z-index: 0;
        }

        .noise-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
            opacity: 0.05;
            pointer-events: none;
            z-index: 50;
        }
    </style>
</head>
<body class="demon-scrollbar overflow-x-hidden">
    <div class="noise-overlay"></div>
    
    <!-- Background Auras -->
    <div class="aura-effect top-[-200px] left-[-200px] animate-pulse-slow"></div>
    <div class="aura-effect bottom-[-200px] right-[-200px] animate-pulse-slow" style="animation-delay: 2s;"></div>

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 w-full z-40 px-6 py-4 flex justify-between items-center demon-glass border-b border-demon-crimson/20">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-demon-crimson rotate-45 flex items-center justify-center demon-glow-text shadow-[0_0_15px_#FF003C]">
                <span class="text-white font-bold -rotate-45">D</span>
            </div>
            <span class="text-2xl font-bold tracking-tighter text-white">DEMON <span class="text-demon-crimson">FRAMEWORK</span></span>
        </div>
        <div class="hidden md:flex gap-8 text-sm font-medium uppercase tracking-widest">
            <a href="/" class="hover:text-demon-crimson transition-colors">Home</a>
            <a href="#" class="hover:text-demon-crimson transition-colors">Features</a>
            <a href="#" class="hover:text-demon-crimson transition-colors">Docs</a>
            <a href="#" class="hover:text-demon-crimson transition-colors text-demon-crimson">GitHub</a>
        </div>
        <div>
            <button class="px-5 py-2 text-xs font-bold uppercase tracking-widest border border-demon-crimson text-demon-crimson hover:bg-demon-crimson hover:text-white transition-all duration-300">
                Install CLI
            </button>
        </div>
    </nav>

    <main class="relative z-10 w-full">
        @yield('main_content')
    </main>

    <footer class="relative z-10 bg-demon-obsidian border-t border-demon-crimson/10 py-20 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-2">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-6 h-6 bg-demon-crimson rotate-45"></div>
                    <span class="text-xl font-bold tracking-tighter text-white uppercase">Demon Framework</span>
                </div>
                <p class="text-gray-500 max-w-sm">
                    Unleash the devilish performance of the next generation frontend library. Built for the bold, the fast, and the elite.
                </p>
            </div>
            <div>
                <h4 class="text-white font-bold uppercase tracking-widest mb-6">Navigation</h4>
                <ul class="space-y-4 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-demon-crimson transition-colors">Architecture</a></li>
                    <li><a href="#" class="hover:text-demon-crimson transition-colors">Performance</a></li>
                    <li><a href="#" class="hover:text-demon-crimson transition-colors">Security</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold uppercase tracking-widest mb-6">Social</h4>
                <ul class="space-y-4 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-demon-crimson transition-colors">Twitter</a></li>
                    <li><a href="#" class="hover:text-demon-crimson transition-colors">Discord</a></li>
                    <li><a href="#" class="hover:text-demon-crimson transition-colors">Github</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-20 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between text-xs text-gray-600 uppercase tracking-widest">
            <p>&copy; 2026 Demon Framework. All rights reserved.</p>
            <p>Built with blood and code.</p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
