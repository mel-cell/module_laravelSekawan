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
                        <a href="#{{ $key }}">{{ $menu }}</a>
                    </li>
                @endforeach
                <li class="mt-4 flex flex-col gap-4 md:flex-row md:items-center lg:mt-0 lg:ml-4">
                    @auth
                        <div class="flex items-center gap-4">
                            <p class="font-medium text-sm text-gray-700">{{ Auth::user()->name ?? 'User' }}</p>
                            <div class="avatar placeholder">
                                <div class="bg-gray-200 text-neutral-content rounded-full w-10 flex items-center justify-center">
                                    <span class="text-lg font-semibold">{{ substr(Auth::user()->name ?? 'U', 0, 1) }}</span>
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
                </li>
            </ul>
        </div>
    </nav>
</div>