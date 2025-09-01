<x-admin.layout>
    <x-slot name="title">Borrowing Details</x-slot>
    
    <div class="flex flex-col gap-1 lg:gap-2">
        <h1 class="font-semibold md:text-lg">Borrowing Details</h1>
        <div class="flex items-center gap-1">
            <p class="text-xs text-gray-400 md:text-sm">Admin</p>
            <p class="text-xs text-gray-400 md:text-sm">/</p>
            <p class="text-xs text-gray-400 md:text-sm"><a href="{{ route('admin.borrowing.index') }}" class="text-blue-500 hover:underline">Borrowings</a></p>
            <p class="text-xs text-gray-400 md:text-sm">/</p>
            <p class="text-xs text-gray-400 md:text-sm">Detail</p>
        </div>
        
        @if (session('success'))
            <div class="flash-message bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div class="flash-message bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6 my-4">
            <h2 class="text-lg font-semibold mb-4">Transaction Information (ID: {{ $borrowing->borrowing_id }})</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-600">Borrower Name:</p>
                    <p class="font-semibold">{{ $borrowing->user->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Borrower Email:</p>
                    <p class="font-semibold">{{ $borrowing->user->email ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Borrowed Date:</p>
                    <p class="font-semibold">{{ $borrowing->borrowing_borrowed_at?->format('d M Y') ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Returned Date:</p>
                    <p class="font-semibold">{{ $borrowing->returned_at?->format('d M Y H:i') ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status:</p>
                    <p class="font-semibold">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $borrowing->borrowing_returned ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $borrowing->borrowing_returned ? 'Returned' : 'Borrowed' }}
                        </span>
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Fine:</p>
                    <p class="font-semibold">{{ $borrowing->borrowing_fine ?? '0' }}</p>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <p class="text-sm text-gray-600">Notes:</p>
                    <p class="font-semibold">{{ $borrowing->borrowing_notes ?? '-' }}</p>
                </div>
            </div>

            <h3 class="text-lg font-semibold mb-4 mt-6">Borrowed Books</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border-b text-left">No</th>
                            <th class="py-2 px-4 border-b text-left">Book Title</th>
                            <th class="py-2 px-4 border-b text-left">ISBN</th>
                            <th class="py-2 px-4 border-b text-left">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowing->borrowingDetails as $index => $detail)
                            <tr>
                                <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                                <td class="py-2 px-4 border-b">{{ $detail->book->book_name ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b">{{ $detail->book->book_isbn ?? 'N/A' }}</td>
                                <td class="py-2 px-4 border-b">{{ $detail->detail_quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">No books found in this borrowing transaction</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-6">
                <a href="{{ route('admin.borrowing.index') }}" 
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Back to List
                </a>
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
</x-admin.layout>

