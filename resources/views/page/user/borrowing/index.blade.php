<x-user.layout> {{-- Asumsi Anda punya layout untuk user --}}
    <x-slot name="title">My Borrowings</x-slot>

    <div class="flex flex-col gap-1 lg:gap-2">
        <h1 class="font-semibold md:text-lg">My Borrowings</h1>
        <div class="flex items-center gap-1">
            <p class="text-xs text-gray-400 md:text-sm">User</p>
            <p class="text-xs text-gray-400 md:text-sm">/</p>
            <p class="text-xs text-gray-400 md:text-sm">My Borrowings</p>
        </div>
        
        {{-- Flash Messages (Success/Error) --}}
        <div class="flash-message-container">
            @if (session('success'))
                <div class="flash-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @elseif (session('error'))
                <div class="flash-message bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <!-- hero section -->
        <x-slot name="hero">
        <div></div>
        </x-slot>

        <!-- Borrowings Table -->
        <div class="bg-white shadow-md rounded-lg p-6 h-96 my-4">
            <h2 class="text-lg font-semibold mb-4">My Borrowings List</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b text-left">No</th>
                            <th class="py-2 px-4 border-b text-left">Borrowed At</th>
                            <th class="py-2 px-4 border-b text-left">Returned At</th>
                            <th class="py-2 px-4 border-b text-left">Status</th>
                            <th class="py-2 px-4 border-b text-left">Fine</th>
                            <th class="py-2 px-4 border-b text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowings as $index => $borrowing)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $index + $borrowings->firstItem() }}</td>
                                <td class="py-2 px-4 border-b">{{ $borrowing->borrowing_borrowed_at?->format('d M Y') ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b">{{ $borrowing->returned_at?->format('d M Y H:i') ?? '-' }}</td>
                                <td class="py-2 px-4 border-b">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $borrowing->borrowing_returned ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $borrowing->borrowing_returned ? 'Returned' : 'Borrowed' }}
                                    </span>
                                </td>
                                <td class="py-2 px-4 border-b">{{ $borrowing->borrowing_fine ?? '0' }}</td>
                                <td class="py-2 px-4 border-b">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('user.borrowing.show', $borrowing->borrowing_id) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                            View Details
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">You have no active or past borrowings.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Pagination Links --}}
            <div class="mt-4 flex justify-center">
                {{ $borrowings->links() }}
            </div>
        </div>
    </div>

    {{-- Script for flash messages --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(message => {
                setTimeout(() => {
                    message.style.display = 'none';
                }, 5000); 
            });
        });
    </script>
</x-user.layout>

