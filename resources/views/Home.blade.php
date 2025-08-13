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
                    <a href="{{ url('/') }}">Home</a>
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
        <div 
            class="hero min-h-screen relative" 
            style="background-image: url(https://images.unsplash.com/photo-1512820790803-83ca734da794); background-size: cover; background-position: center;">
            
            <div class="absolute inset-0 bg-black opacity-40"></div>
            
            <div class="hero-content text-center text-neutral-content z-10 relative flex flex-col items-center justify-center">
                <div class="max-w-md md:max-w-lg lg:max-w-xl mt-80">
                <h1 class="mb-5 text-xl font-semibold text-white md:text-3xl lg:text-4xl">Welcome to Library App</h1>
                <p class="mb-5 text-sm text-white md:text-base">Choose from a wide range of popular books from all the categories you want here.</p>
                <a href="#" class="btn btn-sm bg-gray-800 text-white">Check Our Books</a>
                </div>
            </div>
        </div>
    </main>
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
