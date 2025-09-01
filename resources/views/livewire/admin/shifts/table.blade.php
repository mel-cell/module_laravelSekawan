<div>
    <h2 class="text-lg font-semibold mb-4">Shelves List</h2>

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name or location..."
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b text-left">No</th>
                    <th class="py-2 px-4 border-b text-left">Name</th>
                    <th class="py-2 px-4 border-b text-left">Location</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shifts as $index => $shelf)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $index + $shifts->firstItem() }}</td>
                        <td class="py-2 px-4 border-b">{{ $shelf->shelf_name }}</td>
                        <td class="py-2 px-4 border-b">{{ \Illuminate\Support\Str::limit($shelf->shelf_position, 50) }}</td>
                        <td class="py-2 px-4 border-b">
                            <div class="flex space-x-2">
                                <button onclick="editShelf('{{ $shelf->shelf_id }}', '{{ $shelf->shelf_name }}', '{{ $shelf->shelf_position }}')"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Edit
                                </button>
                                <button type="button"
                                        onclick="confirmDelete('{{ $shelf->shelf_id }}')"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No shelves found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Pagination Links --}}
    <div class="mt-4 flex justify-center">
        {{ $shifts->links() }}
    </div>
</div>
