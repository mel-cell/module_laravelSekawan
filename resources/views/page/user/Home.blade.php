<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library App - Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-gray-100">
    <nav class="bg-white px-4 py-4 md:px-8 lg:py-3">
        <div class="flex flex-wrap justify-between items-center lg:flex-nowrap">
            <h1 class="font-semibold">Library App</h1>
            <button class="block lg:hidden" id="navButton">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="hidden flex-col items-center gap-2 w-full mt-4 lg:flex lg:w-fit lg:flex-row lg:mt-0"
                id="navMenu">
                <li class="px-4 py-2 text-sm font-medium transition-all duration-300 rounded hover:bg-gray-200">
                    <a href="#">Home</a>
                </li>
                <li class="px-4 py-2 text-sm font-medium transition-all duration-300 rounded hover:bg-gray-200">
                    <a href="#">Book</a>
                </li>
                <li class="mt-4 flex flex-col gap-4 md:flex-row md:items-center lg:mt-0 lg:ml-4">
                   @guest
                        <a href="{{ route('login') }}">
                            <button class="px-3 py-2 border border-gray-800 rounded text-xs font-medium block w-full transition-all duration-300 hover:bg-gray-800 hover:text-white lg:text-sm">Login</button>
                        </a>
                        <a href="{{ route('register') }}">
                            <button class="px-3 py-2 bg-gray-800 rounded text-xs font-medium text-white block w-full lg:text-sm">Register</button>
                        </a>
                    @else
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-2 bg-red-600 rounded text-xs font-medium text-white block w-full lg:text-sm">Logout</button>
                        </form>
                    @endguest
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <!-- Hero Section -->
        <section class="w-full h-48 flex items-center justify-center bg-gray-50 md:h-64 lg:h-72">
            <div class="flex justify-between items-center gap-12 lg:gap-24">
                <div class="hidden md:block md:w-fit md:rounded md:overflow-hidden">
                    <img src="{{ asset('assets/img/matahari.jpeg') }}" alt="Book Image" class="w-28 lg:w-32">
                </div>
                <div class="flex flex-col items-center gap-2 md:items-start">
                    <h1 class="font-semibold">WELCOME TO LIBRARY APP</h1>
                    <p class="text-sm">Choose the best books you want to read in here.</p>
                    <a href="#books">
                        <button class="px-3 py-2 mt-2 bg-gray-800 rounded text-xs font-medium text-white lg:text-sm">Check Our Books</button>
                    </a>
                </div>
            </div>
        </section>

        <!-- Section Buku -->
        <section id="books" class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Featured Books</h2>
                    <p class="mt-2 text-gray-600">Discover our collection of amazing books</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                    @foreach($books as $book)
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
            </div>
        </section>

        <!-- Section Kategori -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Book Categories</h2>
                    <p class="mt-2 text-gray-600">Explore books by category</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                    @foreach($categories as $category)
                        <div class="bg-white rounded-lg shadow-md p-6 text-center hover:shadow-lg transition-shadow duration-300">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-folder text-blue-600 text-xl"></i>
                            </div>
                            <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-600 mt-1">{{ $category->books_count ?? 0 }} books</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">Library App</h3>
                    <p class="text-gray-300 text-sm">
                        Your digital library solution for managing and discovering books.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="#books" class="text-gray-300 hover:text-white">Books</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Categories</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <div class="space-y-2 text-sm text-gray-300">
                        <p><i class="fas fa-envelope mr-2"></i>info@libraryapp.com</p>
                        <p><i class="fas fa-phone mr-2"></i>+1 234 567 890</p>
                        <p><i class="fas fa-map-marker-alt mr-2"></i>123 Library Street, Book City</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center">
                <p class="text-gray-400 text-sm">&copy; 2024 Library App. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

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

</html>
