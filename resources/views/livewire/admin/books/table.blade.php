<div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-4">Books List</h2>
        <div class="mb-4">
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search books..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 border-b text-left">No</th>
                        <th class="py-2 px-4 border-b text-left">Title</th>
                        <th class="py-2 px-4 border-b text-left">Author</th>
                        <th class="py-2 px-4 border-b text-left">Publisher</th>
                        <th class="py-2 px-4 border-b text-left">Category</th>
                        <th class="py-2 px-4 border-b text-left">Shelf</th>
                        <th class="py-2 px-4 border-b text-left">Publication Year</th>
                        <th class="py-2 px-4 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $index => $book)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $index + $books->firstItem() }}</td>
                            <td class="py-2 px-4 border-b">{{ $book->book_name }}</td>
                            {{-- Menampilkan data relasi --}}
                            <td class="py-2 px-4 border-b">{{ $book->author->author_name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $book->publisher->publisher_name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $book->category->category_name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $book->shelf->shelf_name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $book->publication_year }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.books.edit', $book->book_id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                        Edit
                                    </a>
                                    <button type="button"
                                            onclick="confirmDelete('{{ $book->book_id }}')"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No books found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Pagination Links --}}
        <div class="mt-4 flex justify-center">
            {{ $books->links() }}
        </div>
    </div>

    <div id="deleteConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full flex items-center justify-center z-50">
        <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Deletion</h3>
                <p class="text-gray-700 mb-6">Are you sure you want to delete this book? This action cannot be undone.</p>
                <div class="flex justify-center space-x-4">
                    <button type="button" onclick="closeDeleteConfirmModal()"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(message => {
                setTimeout(() => {
                    message.style.display = 'none';
                }, 5000); 
            });
        });

        function confirmDelete(id) {
            document.getElementById('deleteForm').action = `/admin/book/${id}`; 
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function closeDeleteConfirmModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }
    </script>