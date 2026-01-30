@extends('layouts/master')

@section('main_content')

<!-- Hero Section -->
<section class="min-h-screen flex flex-col justify-center items-center px-6 pt-32 pb-20 overflow-hidden relative">
    <div class="absolute inset-0 z-0 overflow-hidden">
        <canvas id="demon-canvas" class="absolute inset-0 w-full h-full opacity-60"></canvas>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-demon-crimson/10 rounded-full blur-[120px] animate-pulse-slow"></div>
    </div>

    <div class="relative z-10 text-center max-w-5xl">
        <div class="inline-flex items-center gap-3 px-4 py-2 demon-glass-sharp border border-demon-crimson/30 rounded-full mb-8 transform hover:scale-105 transition-transform cursor-default">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-demon-crimson opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-demon-crimson"></span>
            </span>
            <span class="text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">Stable Version 6.6.6 is out</span>
        </div>

        <h1 class="text-6xl md:text-8xl lg:text-9xl font-bold tracking-[-0.05em] leading-[0.9] text-white uppercase mb-8 text-reflection" data-text="DEVILISH">
            DEVILISH <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-b from-white to-demon-charcoal" style="-webkit-text-stroke: 1px rgba(255, 255, 255, 0.1);">SPEED.</span>
        </h1>

        <p class="text-lg md:text-xl text-gray-400 max-w-2xl mx-auto mb-12 font-medium tracking-tight">
            The frontend library for those who demand <span class="text-demon-crimson">absolute dominance</span>. Razor-sharp components, aggressive performance, and an aesthetic that intimidates.
        </p>

        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
            <a href="/docs" class="group relative px-10 py-5 bg-demon-crimson text-white font-bold uppercase tracking-widest text-sm transition-all duration-300 hover:shadow-[0_0_30px_rgba(255,0,60,0.6)] active:scale-95 text-center">
                Unleash the Power
                <div class="absolute inset-0 border border-white/20 group-hover:scale-110 transition-transform duration-300"></div>
            </a>
            <a href="/showcase" class="px-10 py-5 demon-glass-sharp border border-white/10 text-white font-bold uppercase tracking-widest text-sm hover:border-demon-crimson/50 hover:bg-white/5 transition-all active:scale-95 text-center">
                View the Abyss
            </a>
        </div>
    </div>
</section>

<!-- Bento Grid Features -->
<section id="features" class="max-w-7xl mx-auto px-6 py-32">
    <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
        <div class="max-w-xl">
            <h2 class="text-4xl md:text-6xl font-bold text-white uppercase tracking-tighter mb-6">Infernal Features</h2>
            <p class="text-gray-500 text-lg uppercase tracking-widest font-bold">Uncompromising capability for the modern web.</p>
        </div>
        <div class="text-right">
            <span class="text-8xl font-black text-white/5 select-none">01-06</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-6 grid-rows-auto gap-4">
        <!-- Feature 1: Big Card -->
        <div class="md:col-span-4 md:row-span-2 demon-glass-sharp border-white/5 p-12 relative overflow-hidden group hover:border-demon-crimson/40 transition-colors duration-500" data-tilt data-tilt-max="5" data-tilt-glare data-tilt-max-glare="0.1">
            <div class="absolute top-0 right-0 p-8">
                <svg class="w-12 h-12 text-demon-crimson animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
            <div class="relative z-10">
                <h3 class="text-3xl font-bold text-white uppercase tracking-tighter mb-4">Devilish Speed</h3>
                <p class="text-gray-400 text-lg max-w-md">
                    Our hydration engine is optimized to the bone. Zero-latency transitions and sub-millisecond response times mean your users never wait.
                </p>
                <div class="mt-12 flex gap-4">
                    <div class="h-1 flex-1 bg-white/10 relative overflow-hidden">
                        <div class="absolute inset-0 bg-demon-crimson w-2/3"></div>
                    </div>
                    <span class="text-[10px] font-bold text-demon-crimson uppercase tracking-widest">Hydration Speed: 0.2ms</span>
                </div>
            </div>
            <div class="absolute bottom-[-50px] left-[-50px] w-64 h-64 bg-demon-crimson/10 rounded-full blur-3xl group-hover:bg-demon-crimson/20 transition-all duration-700"></div>
        </div>

        <!-- Feature 2: Small Card -->
        <div class="md:col-span-2 demon-glass-sharp border-white/5 p-8 hover:border-demon-crimson/40 transition-colors group" data-tilt data-tilt-scale="1.05">
            <h3 class="text-xl font-bold text-white uppercase tracking-tighter mb-4">Shadow DOM</h3>
            <p class="text-sm text-gray-500">Total isolation by default. Styles never leak, components never conflict.</p>
            <div class="mt-8 flex justify-end">
                <div class="w-8 h-8 rounded-full border border-white/10 flex items-center justify-center group-hover:border-demon-crimson transition-colors">
                    <svg class="w-4 h-4 text-gray-600 group-hover:text-demon-crimson" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>
        </div>

        <!-- Feature 3: Small Card -->
        <div class="md:col-span-2 demon-glass-sharp border-white/5 p-8 hover:border-demon-crimson/40 transition-colors group" data-tilt data-tilt-scale="1.05">
            <h3 class="text-xl font-bold text-white uppercase tracking-tighter mb-4">Neon State</h3>
            <p class="text-sm text-gray-500">Reactive stores with zero boilerplate. State management that actually makes sense.</p>
            <div class="mt-8">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full bg-demon-crimson border-2 border-demon-obsidian"></div>
                    <div class="w-8 h-8 rounded-full bg-demon-charcoal border-2 border-demon-obsidian flex items-center justify-center">
                        <span class="text-[8px] text-white">N</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feature 4: Medium Card -->
        <div class="md:col-span-3 demon-glass-sharp border-white/5 p-10 hover:border-demon-crimson/40 transition-colors" data-tilt data-tilt-glare data-tilt-max-glare="0.2">
            <h3 class="text-2xl font-bold text-white uppercase tracking-tighter mb-4">Razor Routing</h3>
            <p class="text-gray-500 mb-8 text-sm">Type-safe client-side routing that's blindingly fast. Predictive pre-fetching comes standard.</p>
            <div class="space-y-2">
                <div class="h-8 bg-white/5 rounded flex items-center px-4 gap-4">
                    <span class="text-demon-crimson text-[10px]">GET</span>
                    <span class="text-white text-[10px] font-mono">/vault/secrets</span>
                </div>
                <div class="h-8 bg-white/5 rounded flex items-center px-4 gap-4 opacity-50">
                    <span class="text-gray-500 text-[10px]">POST</span>
                    <span class="text-gray-500 text-[10px] font-mono">/auth/sacrifice</span>
                </div>
            </div>
        </div>

        <!-- Feature 5: Medium Card -->
        <div class="md:col-span-3 demon-glass-sharp border-white/5 p-10 hover:border-demon-crimson/40 transition-colors" data-tilt data-tilt-glare data-tilt-max-glare="0.2">
            <h3 class="text-2xl font-bold text-white uppercase tracking-tighter mb-4">Infernal CLI</h3>
            <p class="text-gray-500 mb-8 text-sm">Code generation at warp speed. Scaffold entire features with a single, brutal command.</p>
            <div class="bg-black/40 rounded p-4 font-mono text-[10px] border border-white/5">
                <span class="text-emerald-500">$</span> demon forge --app "Apocalypse"
                <br><span class="text-gray-600">Generating souls... Done in 0.04s</span>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    // --- THREE.JS 3D ENGINE ---
    const canvas = document.querySelector('#demon-canvas');
    const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    camera.position.z = 6;

    const demonGroup = new THREE.Group();
    scene.add(demonGroup);

    // 1. The Head (Abstracted Mask)
    const headGeo = new THREE.IcosahedronGeometry(1.5, 0);
    const headMat = new THREE.MeshPhongMaterial({
        color: 0x111111,
        emissive: 0xFF003C,
        emissiveIntensity: 0.1,
        flatShading: true,
        transparent: true,
        opacity: 0.9,
    });
    const head = new THREE.Mesh(headGeo, headMat);
    demonGroup.add(head);

    // 2. The Horns
    const hornGeo = new THREE.ConeGeometry(0.4, 2, 8);
    const hornMat = new THREE.MeshPhongMaterial({ color: 0xFF003C, emissive: 0xFF003C, emissiveIntensity: 0.3 });
    
    // Right Horn
    const hornRight = new THREE.Mesh(hornGeo, hornMat);
    hornRight.position.set(1, 1.2, 0);
    hornRight.rotation.z = -Math.PI / 4;
    demonGroup.add(hornRight);

    // Left Horn
    const hornLeft = new THREE.Mesh(hornGeo, hornMat);
    hornLeft.position.set(-1, 1.2, 0);
    hornLeft.rotation.z = Math.PI / 4;
    demonGroup.add(hornLeft);

    // 3. The Eyes (Glowing Spheres)
    const eyeGeo = new THREE.SphereGeometry(0.15, 16, 16);
    const eyeMat = new THREE.MeshBasicMaterial({ color: 0xFF003C });
    
    const eyeRight = new THREE.Mesh(eyeGeo, eyeMat);
    eyeRight.position.set(0.5, 0.2, 1.3);
    demonGroup.add(eyeRight);

    const eyeLeft = new THREE.Mesh(eyeGeo, eyeMat);
    eyeLeft.position.set(-0.5, 0.2, 1.3);
    demonGroup.add(eyeLeft);

    // 4. Orbiting Shards
    const shardGeo = new THREE.TetrahedronGeometry(0.2, 0);
    const shards = [];
    for(let i = 0; i < 8; i++) {
        const shard = new THREE.Mesh(shardGeo, hornMat);
        const radius = 2.5 + Math.random();
        const angle = (i / 8) * Math.PI * 2;
        shard.position.set(Math.cos(angle) * radius, Math.sin(angle) * radius, (Math.random() - 0.5) * 2);
        demonGroup.add(shard);
        shards.push({ mesh: shard, angle, radius, speed: 0.01 + Math.random() * 0.02 });
    }

    // Lighting
    const mainLight = new THREE.PointLight(0xFF003C, 100, 100);
    mainLight.position.set(2, 2, 5);
    scene.add(mainLight);
    
    const ambientLight = new THREE.AmbientLight(0xFFFFFF, 0.5);
    scene.add(ambientLight);

    // Animation Loop
    const clock = new THREE.Clock();
    const animate = () => {
        const elapsedTime = clock.getElapsedTime();
        
        // Float movement
        demonGroup.position.y = Math.sin(elapsedTime) * 0.2;
        demonGroup.rotation.y = Math.sin(elapsedTime * 0.5) * 0.2;
        
        // Pulsing eyes
        const eyeScale = 1 + Math.sin(elapsedTime * 4) * 0.2;
        eyeRight.scale.set(eyeScale, eyeScale, eyeScale);
        eyeLeft.scale.set(eyeScale, eyeScale, eyeScale);
        
        // Animate shards
        shards.forEach(s => {
            s.angle += s.speed;
            s.mesh.position.x = Math.cos(s.angle) * s.radius;
            s.mesh.position.z = Math.sin(s.angle) * s.radius;
            s.mesh.rotation.x += 0.05;
        });

        renderer.render(scene, camera);
        requestAnimationFrame(animate);
    };
    animate();

    // Mouse Parallax
    window.addEventListener('mousemove', (e) => {
        const x = (e.clientX / window.innerWidth - 0.5) * 2;
        const y = (e.clientY / window.innerHeight - 0.5) * 2;
        gsap.to(demonGroup.rotation, { y: x * 0.5, x: -y * 0.3, duration: 1 });
    });

    window.addEventListener('resize', () => {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
    });

    // --- GSAP ANIMATIONS ---
    gsap.registerPlugin(ScrollTrigger);

    // Hero Entry
    const tl = gsap.timeline();
    tl.from('h1', { y: 100, opacity: 0, duration: 1.2, ease: 'power4.out' })
      .from('p.text-lg', { y: 20, opacity: 0, duration: 0.8, ease: 'power3.out' }, '-=0.8')
      .from('.flex.flex-col.sm\\:flex-row.gap-6', { y: 20, opacity: 0, duration: 0.8, ease: 'power3.out' }, '-=0.6');

    // Section Headers
    gsap.utils.toArray('h2').forEach(heading => {
        gsap.from(heading, {
            scrollTrigger: {
                trigger: heading,
                start: 'top 85%',
            },
            x: -50,
            opacity: 0,
            duration: 1,
            ease: 'power3.out'
        });
    });

    // Feature Cards Stagger
    gsap.from('.demon-glass-sharp', {
        scrollTrigger: {
            trigger: '#features',
            start: 'top 70%',
        },
        y: 60,
        opacity: 0,
        rotateX: -15,
        stagger: 0.15,
        duration: 1,
        ease: 'power2.out'
    });
</script>
@endsection