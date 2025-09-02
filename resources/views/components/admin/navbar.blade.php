<header class="bg-white border-b border-b-gray-200 shadow-md px-4 py-3 flex justify-between items-center md:px-8">
    <div class="font-semibold">Admin Library</div>
    <button class="lg:hidden rounded-md focus:outline-none" id="menuButton">
        <i class="fas fa-bars"></i>
    </button>
    <div class="hidden lg:flex lg:items-center lg:gap-4">
        @auth
            <div class="flex items-center gap-4">
                <p class="font-medium text-sm text-gray-700">{{ Auth::user()->name ?? 'User' }}</p>
                <div class="avatar">
                    <div class="w-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img src="{{ Auth::user()->profile_image_url }}" alt="Profile" class="object-cover">
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="ml-2">
                    @csrf
                    <button type="submit" class="px-3 py-2 bg-red-600 rounded text-xs font-medium text-white lg:text-sm">Logout</button>
                </form>
            </div>
        @else
            <div class="flex flex-col gap-4 md:flex-row md:items-center">
                <a href="{{ route('login') }}">
                    <button class="px-3 py-2 border border-gray-800 rounded text-xs font-medium block w-full transition-all duration-300 hover:bg-gray-800 hover:text-white lg:text-sm">Login</button>
                </a>
                <a href="{{ route('register') }}">
                    <button class="px-3 py-2 bg-gray-800 rounded text-xs font-medium text-white block w-full lg:text-sm">Register</button>
                </a>
            </div>
        @endauth
    </div>
</header>
