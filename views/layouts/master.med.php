<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Med Framework' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('resources/css/global.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased selection:bg-brand-500 selection:text-white flex flex-col min-h-screen">
    
    @include('partials/nav')

    <!-- Main Content Wrapper -->
    <main class="flex-grow pt-20"> <!-- pt-20 to account for fixed navbar -->
        <div class="w-full mx-auto">
            @yield('main_content')
        </div>
    </main>

    <div class="mt-auto">
        @include('partials/footer')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('resources/javascript/main.js') }}"></script>
    @yield('scripts')
</body>

</html>