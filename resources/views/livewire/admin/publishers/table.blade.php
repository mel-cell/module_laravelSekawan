<div>
    <h2 class="text-lg font-semibold mb-4">Publishers List</h2>

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search by name or description..."
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b text-left">No</th>
                    <th class="py-2 px-4 border-b text-left">Name</th>
                    <th class="py-2 px-4 border-b text-left">Description</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($publishers as $index => $publisher)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $index + $publishers->firstItem() }}</td>
                        <td class="py-2 px-4 border-b">{{ $publisher->publisher_name }}</td>
                        <td class="py-2 px-4 border-b">{{ \Illuminate\Support\Str::limit($publisher->publisher_description, 50) }}</td>
                        <td class="py-2 px-4 border-b">
                            <div class="flex space-x-2">
                                <button onclick="editPublisher('{{ $publisher->publisher_id }}', '{{ $publisher->publisher_name }}', '{{ $publisher->publisher_description }}')"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Edit
                                </button>
                                <button type="button"
                                        onclick="confirmDelete('{{ $publisher->publisher_id }}')"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">No publishers found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- Pagination Links --}}
    <div class="mt-4 flex justify-center">
        {{ $publishers->links() }}
    </div>
</div>
