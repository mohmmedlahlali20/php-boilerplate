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
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#FF003C', // Demon Crimson as primary
                            600: '#e10035',
                            700: '#c2002e',
                            800: '#a30027',
                            900: '#840020',
                        },
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

        .cyber-grid {
            position: fixed;
            top: 0; left: 0; width: 200%; height: 200%;
            background-image: 
                linear-gradient(rgba(255, 0, 60, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 0, 60, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            transform: perspective(500px) rotateX(60deg) translateY(-20%);
            z-index: -1;
            pointer-events: none;
            animation: grid-drift 20s linear infinite;
        }

        @keyframes grid-drift {
            0% { transform: perspective(500px) rotateX(60deg) translateY(-20%) translateY(0); }
            100% { transform: perspective(500px) rotateX(60deg) translateY(-20%) translateY(50px); }
        }

        .demon-glass {
            background: rgba(10, 10, 10, 0.7);
            backdrop-filter: blur(25px) saturate(180%);
            -webkit-backdrop-filter: blur(25px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.8);
        }

        .demon-glass-sharp {
            background: rgba(5, 5, 5, 0.9);
            backdrop-filter: blur(40px);
            border: 1px solid rgba(255, 0, 60, 0.2);
            box-shadow: inset 0 0 20px rgba(255, 0, 60, 0.05);
        }

        .demon-glow-text {
            text-shadow: 0 0 20px rgba(255, 0, 60, 0.8), 0 0 40px rgba(255, 0, 60, 0.4);
            letter-spacing: -0.05em;
        }

        .demon-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .demon-scrollbar::-webkit-scrollbar-track {
            background: #000;
        }
        .demon-scrollbar::-webkit-scrollbar-thumb {
            background: #1a1a1a;
            border: 2px solid #000;
            border-radius: 10px;
        }
        .demon-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #FF003C;
            box-shadow: 0 0 10px #FF003C;
        }

        .noise-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
            opacity: 0.08;
            pointer-events: none;
            z-index: 100;
        }
        .text-reflection {
            position: relative;
            display: inline-block;
        }
        .text-reflection::after {
            content: attr(data-text);
            position: absolute;
            left: 0; top: 100%;
            transform: scaleY(-0.5) translateY(-20%);
            opacity: 0.1;
            background: linear-gradient(to bottom, white, transparent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            pointer-events: none;
        }
        .cursor-follower {
            position: fixed;
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, rgba(255, 0, 60, 0.4) 0%, rgba(255, 0, 60, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: screen;
            transition: transform 0.1s ease-out;
            transform: translate(-50%, -50%);
        }
        .scroll-progress {
            position: fixed;
            top: 0; left: 0; width: 0%; height: 3px;
            background: linear-gradient(to right, #FF003C, #8B0000);
            z-index: 10000;
        }
    </style>
</head>
<body class="demon-scrollbar font-sans antialiased overflow-x-hidden min-h-screen flex flex-col bg-demon-obsidian">
    <div class="cyber-grid"></div>
    <div class="scroll-progress" id="progress-bar"></div>
    <div class="cursor-follower" id="cursor"></div>
    <div class="noise-overlay"></div>
    
    @include('partials/nav')

    <!-- Main Content Wrapper -->
    <main class="flex-grow pt-20 relative z-10">
        <div class="w-full mx-auto">
            @yield('main_content')
        </div>
    </main>

    <div class="mt-auto relative z-10">
        @include('partials/footer')
    </div>

    <!-- Core Dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.160.0/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>
    
    <!-- Scripts -->
    <script src="{{ asset('resources/javascript/main.js') }}"></script>
    <script>
        const cursor = document.getElementById('cursor');
        const progress = document.getElementById('progress-bar');

        document.addEventListener('mousemove', (e) => {
            gsap.to(cursor, {
                x: e.clientX,
                y: e.clientY,
                duration: 0.5,
                ease: "power2.out"
            });
        });

        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            progress.style.width = scrolled + "%";
        });
    </script>
    @yield('scripts')
</body>
</html>