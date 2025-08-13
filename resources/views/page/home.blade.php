<x-user.layout>
    <x-slot name="title">Home</x-slot>
    
    <x-slot name="hero">
        <div class="hero min-h-screen" style="background-image: url(https://images.unsplash.com/photo-1512820790803-83ca734da794);">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-center text-neutral-content">
                <div class="max-w-lg">
                    <h1 class="mb-5 text-xl font-semibold text-white md:text-3xl lg:text-4xl">Welcome to Library App</h1>
                    <p class="mb-5 text-sm text-white md:text-base">Choose from a wide range of popular books from all the categories you want here.</p>
                    <a href="#" class="btn btn-sm bg-gray-800 text-white">Check Our Books</a>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Konten utama Home -->
    <div class="max-w-7xl mx-auto">
        <!-- Welcome Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Welcome to Our Library</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-4">About Us</h3>
                    <p class="text-gray-600">We provide access to thousands of books across various categories. Our mission is to make knowledge accessible to everyone.</p>
                </div>
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-4">Featured Books</h3>
                    <p class="text-gray-600">Discover our latest additions and most popular books in our collection.</p>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Library Statistics</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900">Total Books</h3>
                    <p class="text-2xl font-bold text-blue-600 mt-2">{{ $totalBooks ?? '1000+' }}</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900">Active Members</h3>
                    <p class="text-2xl font-bold text-green-600 mt-2">{{ $activeMembers ?? '500+' }}</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-star text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900">Categories</h3>
                    <p class="text-2xl font-bold text-purple-600 mt-2">{{ $categories ?? '50+' }}</p>
                </div>
            </div>
        </section>
    </div>
</x-user.layout>
