@extends('layouts/master')

@section('main_content')
<div class="flex items-center justify-center min-h-[70vh]">
    <div class="text-center px-4">
        <h1 class="text-9xl font-extrabold text-blue-600 tracking-widest">404</h1>
        <div class="bg-blue-600 text-white px-2 text-sm rounded rotate-12 absolute transform -translate-y-16 translate-x-12 lg:translate-x-24">
            Page Not Found
        </div>
        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-800 md:text-3xl">
                Oops! This page doesn't exist.
            </h2>
            <p class="mt-4 text-gray-500">
                The link you followed might be broken, or the page has been moved or deleted.
            </p>
            <div class="mt-10">
                <a href="/" class="px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                    Return Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection