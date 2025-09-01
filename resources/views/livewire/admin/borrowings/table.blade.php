<div>
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
        <h2 class="text-lg font-semibold mb-2 md:mb-0">List of All Borrowings</h2>
        <a href="{{ route('admin.borrowing.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create New Borrowing
        </a>
    </div>

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by username, email, or borrowing ID..."
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-4 border-b">ID Peminjaman</th>
                    <th class="py-2 px-4 border-b">Borrower</th>
                    <th class="py-2 px-4 border-b">Books</th>
                    <th class="py-2 px-4 border-b">Tanggal Peminjaman</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $borrowing)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $borrowing->borrowing_id }}</td>
                    <td class="py-2 px-4 border-b">
                        <div class="text-sm">
                            <div class="font-medium">{{ $borrowing->user->username ?? 'N/A' }}</div>
                            <div class="text-gray-500">{{ $borrowing->user->email ?? '' }}</div>
                        </div>
                    </td>
                    <td class="py-2 px-4 border-b">
                        <div class="text-sm">
                            @foreach($borrowing->borrowingDetails as $detail)
                                <div class="mb-1">
                                    <span class="font-medium">{{ $detail->book->book_name ?? 'N/A' }}</span>
                                    <span class="text-gray-500">({{ $detail->detail_quantity }}x)</span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td class="py-2 px-4 border-b">{{ $borrowing->borrowing_borrowed_at->format('d M Y') }}</td>
                    <td class="py-2 px-4 border-b">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            {{ $borrowing->borrowing_returned ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $borrowing->borrowing_returned ? 'Returned' : 'Not Returned' }}
                        </span>
                    </td>
                    <td class="py-2 px-4 border-b">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.borrowing.show', $borrowing->borrowing_id) }}"
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-sm">
                                Detail
                            </a>
                            @if(!$borrowing->borrowing_returned)
                                <form action="{{ route('admin.borrowing.return', $borrowing->borrowing_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-sm"
                                            onclick="return confirm('Are you sure you want to mark this borrowing as returned?')">
                                        Return
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.borrowing.destroy', $borrowing->borrowing_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm"
                                        onclick="return confirm('Are you sure you want to delete this borrowing?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-4 px-4 text-center text-gray-500">No borrowings found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $borrowings->links() }}
    </div>
</div>
