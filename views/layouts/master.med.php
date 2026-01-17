<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'NAN' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    @include('partials/nav')

    <div class="flex overflow-hidden bg-white pt-16">
        
        @include('partials/sidebar')

        <div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
            <main>
                <div class="pt-6 px-4 min-h-[calc(100vh-120px)]">
                    @yield('main_content')
                </div>
            </main>
            
            @include('partials/footer')
        </div>

    </div>

    @yield('scripts')
</body>
</html>