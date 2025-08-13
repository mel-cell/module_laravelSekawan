<nav class="bg-white border-r border-r-gray-200 text-black w-64 space-y-1 py-6 px-2 absolute inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition duration-200 ease-in-out md:px-4"
    id="sidebar">
    
    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}"
        class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
        <i class="fas fa-home"></i>
        <span>Dashboard</span>
    </a>

    <!-- Books Management -->
    <a href="#"
        class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200">
        <i class="fas fa-book"></i>
        <span>Books</span>
    </a>

    <!-- Categories -->
    <a href="#"
        class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200">
        <i class="fas fa-tags"></i>
        <span>Categories</span>
    </a>

    <!-- Authors -->
    <a href="#"
        class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200">
        <i class="fas fa-user-edit"></i>
        <span>Authors</span>
    </a>

    <!-- Publishers -->
    <a href="#"
        class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200">
        <i class="fas fa-building"></i>
        <span>Publishers</span>
    </a>

    <!-- Users Management -->
    <a href="#"
        class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200">
        <i class="fas fa-users"></i>
        <span>Users</span>
    </a>

    <!-- Borrowings -->
    <a href="#"
        class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200">
        <i class="fas fa-exchange-alt"></i>
        <span>Borrowings</span>
    </a>

    <!-- Settings -->
    <a href="#"
        class="text-sm flex items-center gap-3 px-4 py-3 rounded transition-all duration-300 hover:bg-gray-200">
        <i class="fas fa-gear"></i>
        <span>Settings</span>
    </a>
</nav>
