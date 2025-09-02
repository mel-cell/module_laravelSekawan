<div>
<nav class="bg-white px-4 py-4 md:px-8 lg:py-3">
        <div class="flex flex-wrap justify-between items-center lg:flex-nowrap">
            <h1 class="font-semibold">Library App</h1>
            <button class="block lg:hidden" id="navButton">
                <i class="fas fa-bars"></i>
            </button>
            <ul class="hidden flex-col items-center gap-2 w-full mt-4 lg:flex lg:w-fit lg:flex-row lg:mt-0"
                id="navMenu">
                @foreach($menus as $key => $menu)
                    <li class="px-4 py-2 text-sm font-medium transition-all duration-300 rounded hover:bg-gray-200">
                        @if($key === 'home')
                            @auth
                                <a href="{{ route('user.Home') }}">{{ $menu }}</a>
                            @else
                                <a href="{{ route('Home') }}">{{ $menu }}</a>
                            @endauth
                        @elseif($key === 'books')
                            <a href="#">{{ $menu }}</a>
                        @elseif($key === 'categories')
                            <a href="#">{{ $menu }}</a>
                        @elseif($key === 'borrowings')
                            <a href="{{ route('user.borrowing.index') }}">{{ $menu }}</a>
                        @else
                            <a href="#{{ $key }}">{{ $menu }}</a>
                        @endif
                    </li>
                @endforeach
                <li class="mt-4 flex flex-col gap-4 md:flex-row md:items-center lg:mt-0 lg:ml-4">
                    @auth
                        <div class="flex items-center gap-4">
                            <p class="font-medium text-sm text-gray-700">{{ Auth::user()->name ?? 'User' }}</p>
                            <div class="avatar placeholder">
                                <div class="bg-gray-200 text-neutral-content rounded-full w-10 flex items-center justify-center">
                                    <span class="text-lg font-semibold">{{ substr(Auth::user()->username ?? 'U', 0, 1) }}</span>
                                </div>
                            </div>

                            <!-- Dropdown Menu -->
                            <div class="relative">
                                <button id="dropdownButton" class="flex items-center gap-2 px-3 py-2 bg-gray-800 text-white rounded text-xs font-medium lg:text-sm hover:bg-gray-700">
                                    <i class="fas fa-chevron-down"></i>
                                </button>

                                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                                    <div class="py-1">
                                        <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-cog mr-2"></i>
                                            Settings
                                        </a>
                                        <div class="border-t border-gray-100"></div>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                <i class="fas fa-sign-out-alt mr-2"></i>
                                                Logout
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
                </li>
            </ul>
        </div>
    </nav>

    <script>
        // Dropdown toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownMenu = document.getElementById('dropdownMenu');

            if (dropdownButton && dropdownMenu) {
                dropdownButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenu.classList.toggle('hidden');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!dropdownButton.contains(e.target) && !dropdownMenu.contains(e.target)) {
                        dropdownMenu.classList.add('hidden');
                    }
                });
            }
        });
    </script>
</div>
