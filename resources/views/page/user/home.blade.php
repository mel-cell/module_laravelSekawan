<x-user.layout>
    <x-slot name="title">User Dashboard</x-slot>
    
    <x-slot name="hero">
        <div class="hero h-screen" style="background-image: url(https://images.unsplash.com/photo-1481627834876-b7833e8f5570);">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-center text-neutral-content flex flex-col items-center justify-center h-full">
                <div class="max-w-lg mx-auto text-center">
                    <h1 class="mb-5 text-xl font-semibold text-white md:text-3xl lg:text-4xl">{{ auth()->user()->username ?? 'N/A' }} Dashboard</h1>
                    <p class="mb-5 text-sm text-white md:text-base">Manage your borrowed books and explore our collection.</p>
                    <a href="{{route('user.borrowing.index')}}" class="btn btn-sm bg-gray-800 text-white">View My Books</a>
                </div>
            </div>
        </div>
    </x-slot>

    <!-- Konten utama User Dashboard -->
    <div class="max-w-7xl mx-auto">
        <!-- Dashboard Stats -->
        <section class="mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Dashboard Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-book text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900">Books Borrowed</h3>
                    <p class="text-2xl font-bold text-blue-600 mt-2">{{ $borrowedBooksCount ?? 0 }}</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900">Due Soon</h3>
                    <p class="text-2xl font-bold text-yellow-600 mt-2">{{ $dueSoonCount ?? 0 }}</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-900">Overdue</h3>
                    <p class="text-2xl font-bold text-red-600 mt-2">{{ $overdueCount ?? 0 }}</p>
                </div>
            </div>
        </section>

        <!-- Recent Books -->
        <section>
            <h2 class="text-3xl font-bold text-gray-900 mb-6 text-center">Recently Added Books</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                @foreach($recentBooks as $book)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-book text-4xl text-gray-400"></i>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 truncate">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $book->author->name ?? 'Unknown Author' }}</p>
                            <p class="text-xs text-gray-500 mt-2">{{ $book->category->name ?? 'Uncategorized' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</x-user.layout>
