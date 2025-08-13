@extends('layouts.user')

@section('title', 'Home')

@section('hero')
    <div class="hero min-h-screen"
        style="background-image: url(https://images.unsplash.com/photo-1512820790803-83ca734da794);">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-lg">
                <h1 class="mb-5 text-xl font-semibold text-white md:text-3xl lg:text-4xl">Welcome to Library App
                </h1>
                <p class="mb-5 text-sm text-white md:text-base">Choose from a wide range of popular books from all
                    the categories you want here.</p>
                <a href="#" class="btn btn-sm bg-gray-800 text-white">Check Our Books</a>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <p class="text-center">User Layout</p>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const navButton = document.getElementById('navButton');
            const navMenu = document.getElementById('navMenu');

            navButton.addEventListener('click', () => {
                navMenu.classList.toggle('hidden');
                navMenu.classList.toggle('flex');
            });
        });
    </script>
@endpush