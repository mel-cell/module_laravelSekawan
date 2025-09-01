<div>
    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <div class="mb-4 p-4">
            <input wire:model.live="search" type="search" placeholder="Search authors..." class="w-full px-4 py-2 text-sm text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-300">
        </div>
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($authors as $index => $author)
                    <tr class="text-gray-700">
                        <td class="px-4 py-3 text-sm">{{ $index + $authors->firstItem() }}</td>
                        <td class="px-4 py-3 text-sm">{{ $author->author_name }}</td>
                        <td class="px-4 py-3 text-sm">{{ \Illuminate\Support\Str::limit($author->author_description, 35) }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end space-x-2">
                                <button onclick="editAuthor('{{ $author->author_id }}', '{{ $author->author_name }}', '{{ $author->author_description }}')"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Edit
                                </button>
                                <button type="button"
                                        onclick="confirmDelete('{{ $author->author_id }}')"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-3 text-center text-sm text-gray-500">No authors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $authors->links() }}
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full flex items-center justify-center z-50">
        <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Author</h3>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_name">Name</label>
                        <input type="text" id="edit_name" name="author_name"
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_description">Description</label>
                        <textarea id="edit_description" name="author_description" rows="3"
                                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
                    </div>
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" onclick="closeEditModal()"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancel
                        </button>
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full flex items-center justify-center z-50">
        <div class="relative mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Deletion</h3>
                <p class="text-gray-700 mb-6">Are you sure you want to delete this author? This action cannot be undone.</p>
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

    <script>
        // Script untuk menghilangkan flash message otomatis
        document.addEventListener('DOMContentLoaded', function() {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(message => {
                setTimeout(() => {
                    message.style.display = 'none';
                }, 5000); // Pesan akan hilang setelah 5 detik
            });
        });

        // Edit Modal Functions
        function editAuthor(id, name, description) {
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
            // Pastikan URL sesuai dengan route Anda, misalnya /admin/author/${id}
            document.getElementById('editForm').action = `/admin/author/${id}`;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Delete Confirmation Modal Functions
        function confirmDelete(id) {
            // Pastikan URL sesuai dengan route Anda, misalnya /admin/author/${id}
            document.getElementById('deleteForm').action = `/admin/author/${id}`;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');
        }

        function closeDeleteConfirmModal() {
            document.getElementById('deleteConfirmModal').classList.add('hidden');
        }
    </script>
</div>
